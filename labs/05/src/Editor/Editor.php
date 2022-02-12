<?php

namespace App\Editor;

use App\Command\Editor\EditorInsertImage;
use App\Command\Editor\EditorInsertParagraph;
use App\Command\Editor\EditorListCommand;
use App\Command\Editor\EditorRedoCommand;
use App\Command\Editor\EditorReplaceTextCommand;
use App\Command\Editor\EditorResizeImageCommand;
use App\Command\Editor\EditorSetTitleCommand;
use App\Command\Editor\EditorUndoCommand;
use App\Menu\Menu;
use App\Command\Menu\MenuHelpCommand;
use App\Command\Menu\MenuExitCommand;
use App\Model\Document\Document;
use App\Model\Document\DocumentInterface;

class Editor
{
    private $stream;
    private Menu $menu;
    private DocumentInterface $document;

    public function __construct($stream = STDIN)
    {
        $this->stream = $stream;
        $this->document = new Document();
        $this->menu = new Menu($this->stream);

        $this->menu->addItem('help', 'Help', new MenuHelpCommand($this->menu));
        $this->menu->addItem('exit', 'Exit', new MenuExitCommand($this->menu));
        $this->menu->addItem('setTitle', 'Changes title. Args: <new title>', new EditorSetTitleCommand($this));
        $this->menu->addItem('list', 'Show document', new EditorListCommand($this));
        $this->menu->addItem('undo', 'Undo command', new EditorUndoCommand($this));
        $this->menu->addItem('redo', 'Redo command', new EditorRedoCommand($this));

        $this->menu->addItem('insertParagraph', 'Insert paragraph. Args: <position>|end <text>', new EditorInsertParagraph($this));
        $this->menu->addItem('insertImage', 'Insert image. Args: <position>|end <width> <height> <filepath>', new EditorInsertImage($this));
        $this->menu->addItem('replaceText','Replace text in paragraph. Args: <position> <text>', new EditorReplaceTextCommand($this));
        $this->menu->addItem('resizeImage','Resize image. Args: <position> <width> <height>', new EditorResizeImageCommand($this));
    }

    public function start(): void
    {
        $this->menu->showInstructions();
        $this->menu->run();
    }

    public function undo(): void
    {
        if ($this->document->canUndo()) {
            $this->document->undo();
        } else {
            echo "Can't undo\n";
        }
    }

    public function redo(): void
    {
        if ($this->document->canRedo()) {
            $this->document->redo();
        } else {
            echo "Can't redo\n";
        }
    }

    public function list(): void
    {
        echo "----------\n";
        echo "Title: " . $this->document->getTitle() . "\n";
        $count = $this->document->getItemCount();
        for ($i = 0; $i < $count; $i++)
        {
            $item = $this->document->getItemConst($i);
            $image = $item->getImage();
            $paragraph = $item->getParagraph();
            if ($image !== null) {
                echo $i . '.' . ' Image: ' .$image->getWidth() . 'x' . $image->getHeight() . ' ' . $image->getPath() . "\n";
            }
            if ($paragraph !== null) {
                echo $i . '.' . ' Paragraph: ' . $paragraph->getText() . "\n";
            }
        }
        echo "----------\n";
    }

    public function setTitle(): void
    {
        $title = stream_get_line($this->stream, 65535, "\n");
        $title = trim($title);
        $this->document->setTitle($title);
    }

    public function insertParagraph(): void
    {
        $str = stream_get_line($this->stream, 65535, "\n");

        $r = preg_match('/^(?<pos>(end)|([0-9]+))\s(?<text>.*)$/', $str, $match);
        if (!$r || !is_array($match)) {
            echo "Error: incorrect arguments\n";
            return;
        }
        $position = $match['pos'] == 'end' ? null : (int) $match['pos'];
        $text = $match['text'] ?? '';

        if ($position !== null && $position > $this->document->getItemCount()) {
            echo "Error: Position more then document items count\n";
            return;
        }

        $this->document->insertParagraph($text, $position);
    }

    public function insertImage(): void
    {
        $str = stream_get_line($this->stream, 65535, "\n");

        $position = null;
        $path = '';

        if (sscanf($str, "end%d%d%s", $width, $height, $path) < 1) {
            if (sscanf($str, "%d%d%d%s", $position, $width, $height, $path) < 1) {
                echo "Error: incorrect arguments\n";
                return;
            }
        }

        if (!file_exists($path)) {
            echo "Error: File ($path) not exists\n";
            return;
        }

        if (!$this->checkImageSize($width, $height)) {
            return;
        }

        if ($position !== null && $position > $this->document->getItemCount()) {
            echo "Error: Position more then document items count\n";
            return;
        }

        $this->document->insertImage($path, $width, $height, $position);
    }

    public function replaceText(): void
    {
        $str = stream_get_line($this->stream, 65535, "\n");

        $r = preg_match('/^(?<pos>[0-9]+)\s(?<text>.*)$/', $str, $match);
        if (!$r || !is_array($match)) {
            echo "Error: incorrect arguments\n";
            return;
        }
        $position = (int) $match['pos'];
        $text = $match['text'] ?? '';

        if ($position >= $this->document->getItemCount()) {
            echo "Error: Position more then document items count\n";
            return;
        }

        $item = $this->document->getItemConst($position);
        if ($this->document->getItemCount() === 0 || $item->getParagraph() === null) {
            echo "Error: in the position is not a paragraph\n";
            return;
        }

        $this->document->replaceParagraphText($position, $text);
    }

    public function resizeImage(): void
    {
        $str = stream_get_line($this->stream, 65535, "\n");

        $r = preg_match('/^(?<pos>[0-9]+)\s(?<width>[0-9]+)\s(?<height>[0-9]+)/', $str, $match);
        if (!$r || !is_array($match)) {
            echo "Error: incorrect arguments\n";
            return;
        }
        $position = (int) $match['pos'];
        $width = $match['width'] ?? 0;
        $height = $match['height'] ?? 0;

        if (!$this->checkImageSize($width, $height)) {
            return;
        }

        if ($position >= $this->document->getItemCount()) {
            echo "Error: Position more then document items count\n";
            return;
        }

        $item = $this->document->getItemConst($position);
        if ($this->document->getItemCount() === 0 || $item->getImage() === null) {
            echo "Error: in the position is not image\n";
            return;
        }

        $this->document->resizeImage($position, $width, $height);

    }

    private function checkImageSize($width, $height): bool
    {
        $min_size = 1;
        $max_size = 10000;

        if ($width > $max_size) {
            echo "Error: To big width size (max size: $max_size)\n";
            return false;
        }
        if ($height > $max_size) {
            echo "Error: To big height size (max size: $max_size)\n";
            return false;
        }
        if ($width < $min_size) {
            echo "Error: To small width size (min size: $min_size)\n";
            return false;
        }
        if ($height < $min_size) {
            echo "Error: To small height size (min size: $min_size)\n";
            return false;
        }
        return true;
    }
}
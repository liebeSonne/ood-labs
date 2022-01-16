<?php

namespace App\Editor;

use App\Command\Editor\EditorListCommand;
use App\Command\Editor\EditorRedoCommand;
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
        echo $this->document->getTitle() . "\n";
        echo "----------\n";
    }

    public function setTitle(): void
    {
        $title = stream_get_line($this->stream, 65535, "\n");
        $title = trim($title);
        $this->document->setTitle($title);
    }
}
<?php

namespace App\Command\Document;

use App\Command\AbstractCommand;
use App\Model\Document\DocumentItem;
use App\Model\Paragraph\Paragraph;
use App\Model\Paragraph\ParagraphInterface;

class InsertParagraphCommand extends AbstractCommand
{
    /**
     * @var DocumentItem[]
     */
    private array $items;

    private ?int $position;
    private string $text;
    private ?ParagraphInterface $paragraph;

    /**
     * @param DocumentItem[] $items
     * @param string $text
     * @param int|null $position
     * @param ParagraphInterface|null $paragraph
     */
    public function __construct(array &$items, string $text, ?int $position = null, ?ParagraphInterface &$paragraph)
    {
        $this->items =& $items;
        $this->text = $text;
        $this->position = $position;
        $this->paragraph =& $paragraph;
    }

    public function doExecute(): void
    {
        $paragraph = new Paragraph($this->text);
        $item = new DocumentItem();
        $item->setParagraph($paragraph);
        $this->paragraph = $item->getParagraph();

        if ($this->position === null) {
            $this->items[] = $item;
        } else {
            array_splice($this->items, $this->position, 0, [$item]);
        }
    }

    public function doUnexecute(): void
    {
        if ($this->position === null) {
            array_pop($this->items);
        } else {
            unset($this->items[$this->position]);
            $this->items = array_values($this->items);
        }
    }
}
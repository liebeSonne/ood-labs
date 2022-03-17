<?php

namespace App\Command\Document;

use App\Command\AbstractCommand;
use App\Model\Document\DocumentItem;

class DeleteItemCommand extends AbstractCommand
{
    /**
     * @var DocumentItem[]
     */
    private array $items;
    private int $position;
    private ?DocumentItem $item;

    /**
     * @param DocumentItem[] $items
     * @param int $position
     */
    public function __construct(array &$items, int $position)
    {
        $this->items =& $items;
        $this->position = $position;
    }

    protected function doExecute(): void
    {
        $item = $this->items[$this->position] ?? null;
        if ($item !== null) {
            $this->item = clone $item;
            unset($this->items[$this->position]);
            $this->items = array_values($this->items);
        }
        if ($item !== null && $item->getImage()) {
            $this->item->getImage()->setMarkDel(true);
        }
    }

    protected function doUnexecute(): void
    {
        if ($this->item !== null) {
            if ($this->item->getImage() !== null) {
                $this->item->getImage()->setMarkDel(false);
            }
            array_splice($this->items, $this->position, 0, [$this->item]);
        }
    }

    public function doDestroy(): void
    {
        if ($this->item !== null && $this->item->getImage() !== null) {
            @unlink($this->item->getImage()->getPath());
        }
    }
}
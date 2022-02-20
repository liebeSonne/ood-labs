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
    private bool $markDel = false;
    private ?string $imagePath = null;

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
        $this->markDel = true;
        if ($item !== null && $item->getImage()) {
            $this->imagePath = $item->getImage()->getPath();
        }
    }

    protected function doUnexecute(): void
    {
        if ($this->item !== null) {
            array_splice($this->items, $this->position, 0, [$this->item]);
        }
        $this->markDel = false;
    }

    public function __destruct()
    {
        if ($this->markDel) {
            if ($this->imagePath !== null) {
                @unlink($this->imagePath);
            }
        }
    }
}
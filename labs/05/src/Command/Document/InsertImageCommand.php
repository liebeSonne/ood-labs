<?php

namespace App\Command\Document;

use App\Command\AbstractCommand;
use App\Model\Document\DocumentItem;
use App\Model\Image\Image;
use App\Model\Image\ImageInterface;

class InsertImageCommand extends AbstractCommand
{
    /**
     * @var DocumentItem[]
     */
    private array $items;

    private ?int $position;
    private int $width;
    private int $height;
    private string $path;
    private ?ImageInterface $image;

    public function __construct(array &$items, string $path, int $width, int $height, ?int $position = null, ?ImageInterface &$image)
    {
        $this->items =& $items;
        $this->position = $position;
        $this->width = $width;
        $this->height = $height;
        $this->path = $path;
        $this->image =& $image;
    }

    protected function doExecute(): void
    {
        $from = $this->path;
        $extension = pathinfo($from, PATHINFO_EXTENSION);
        $to = IMAGES_PATH . '/' . uniqid('',false) . "." .  $extension;

        copy($from, $to);

        $image = new Image($to, $this->width, $this->height);
        $item = new DocumentItem();
        $item->setImage($image);
        $this->image = $item->getImage();

        if ($this->position === null) {
            $this->items[] = $item;
        } else {
            array_splice($this->items, $this->position, 0, [$item]);
        }
    }

    protected function doUnexecute(): void
    {
        if ($this->position === null) {
            array_pop($this->items);
        } else {
            unset($this->items[$this->position]);
            $this->items = array_values($this->items);
        }
    }
}
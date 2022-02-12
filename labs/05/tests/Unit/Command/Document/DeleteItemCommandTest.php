<?php

namespace Tests\Unit\Command\Document;

use App\Command\Document\DeleteItemCommand;
use App\Model\Document\DocumentItem;
use PHPUnit\Framework\TestCase;

class DeleteItemCommandTest extends TestCase
{
    public function testDoExecute(): void
    {
        $items = [
            new DocumentItem(),
            new DocumentItem(),
        ];
        $position = 1;

        $command = new DeleteItemCommand($items, $position);

        $command->execute();

        $this->assertCount(1, $items);
    }

    public function testDoExecuteUnknownPosition(): void
    {
        $items = [
            new DocumentItem(),
            new DocumentItem(),
        ];
        $position = 10;

        $command = new DeleteItemCommand($items, $position);

        $command->execute();

        $this->assertCount(2, $items);
    }

    public function testDoUnexecute(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $position = 1;

        $command = new DeleteItemCommand($items, $position);

        $command->execute();
        $command->unexecute();

        $this->assertCount(2, $items);
    }
}
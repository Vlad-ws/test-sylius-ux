<?php

declare(strict_types=1);

namespace App\State\Processor;

use App\Dto\Book;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProcessorInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

class CreateBookProcessor implements ProcessorInterface
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    /** @param Book|mixed $data */
    public function process(mixed $data, Operation $operation, Context $context): Book
    {
        Assert::isInstanceOf($data, Book::class);

        $this->messageBus->dispatch($data);

        return $data;
    }
}

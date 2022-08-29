<?php

declare(strict_types=1);

namespace App\State\Processor;

use App\Entity\Book;
use App\Message\BookCreated;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Component\Resource\State\ProcessorInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

class CreateBookProcessor implements ProcessorInterface
{
    public function __construct(private MessageBusInterface $messageBus, private EntityManagerInterface $entityManager)
    {
    }

    /** @param Book|mixed $data */
    public function process(mixed $data, RequestConfiguration $configuration): Book
    {
        Assert::isInstanceOf($data, Book::class);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        $this->messageBus->dispatch(new BookCreated($data->getId()));

        return $data;
    }
}

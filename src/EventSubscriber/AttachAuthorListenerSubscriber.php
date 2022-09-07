<?php

namespace App\EventSubscriber;

use App\Dto\Book;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AttachAuthorListenerSubscriber implements EventSubscriberInterface
{
    public function attachAuthor(ResourceControllerEvent $event): void
    {
        /** @var Book $book */
        $book = $event->getSubject();
        // $event->setResponse(new JsonResponse(['title' => $book->title]));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'app.book.post_create' => 'attachAuthor',
        ];
    }
}

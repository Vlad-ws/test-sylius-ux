<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Entity\Book;
use App\Message\BookCreated;
use App\Repository\BookRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Webmozart\Assert\Assert;

class BookCreatedHandler implements MessageHandlerInterface
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function __invoke(BookCreated $bookCreated): void
    {
        $book = $this->bookRepository->find($bookCreated->bookId);
        Assert::isInstanceOf($book, Book::class);

        $data = [
            [$book->getId(), $book->getTitle(), $book->getAuthorName()],
        ];

        $filename = sys_get_temp_dir().'/books.csv';
        $f = fopen($filename, 'w+');

        if ($f === false) {
            die('Error opening the file ' . $filename);
        }

        foreach ($data as $row) {
            fputcsv($f, $row);
        }

        fclose($f);
    }
}

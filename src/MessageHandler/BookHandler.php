<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Dto\Book;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class BookHandler implements MessageHandlerInterface
{
    public function __construct()
    {
    }

    public function __invoke(Book $book): void
    {
        $data = [
            [$book->isbn, $book->title, $book->authorName],
        ];

        $filename = sys_get_temp_dir().'/books.csv';
        $f = fopen($filename, 'a');

        if ($f === false) {
            die('Error opening the file ' . $filename);
        }

        foreach ($data as $row) {
            fputcsv($f, $row);
        }

        fclose($f);
    }
}

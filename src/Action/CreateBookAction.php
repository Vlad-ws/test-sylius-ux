<?php

declare(strict_types=1);

namespace App\Action;

use App\Entity\Book;

class CreateBookAction
{
    public function __invoke(Book $data): Book
    {
        return $data->setTitle('New title');
    }
}

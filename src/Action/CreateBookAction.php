<?php

declare(strict_types=1);

namespace App\Action;

use App\Dto\Book;

class CreateBookAction
{
    public function __invoke(): Book
    {
        return new Book(title: 'New title');
    }
}

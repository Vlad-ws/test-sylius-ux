<?php

declare(strict_types=1);

namespace App\Message;

class BookCreated
{
    public function __construct(public int $bookId)
    {
    }
}

<?php

declare(strict_types=1);

namespace App\Dto;

use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class Book implements ResourceInterface
{
    public function __construct(
        #[NotBlank] public ?string $isbn = null,
        #[NotBlank] public ?string $title = null,
        #[NotBlank] public ?string $authorName = null,
    ) {
    }

    public function getId(): ?string
    {
        return $this->isbn;
    }
}

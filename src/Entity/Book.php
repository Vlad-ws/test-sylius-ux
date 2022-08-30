<?php

namespace App\Entity;

use App\Action\CreateBookAction;
use App\Dto\Book as BookInput;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\State\Processor\CreateBookProcessor;
use App\State\Provider\GetBookProvider;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Metadata\Create;
use Sylius\Component\Resource\Metadata\Delete;
use Sylius\Component\Resource\Metadata\Index;
use Sylius\Component\Resource\Metadata\Update;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[Create(controller: CreateBookAction::class, template: '@SyliusUxSemanticUi/crud/create.html.twig', form: BookType::class, section: 'semantic_ui', resource: 'app.book', processor: CreateBookProcessor::class, input: BookInput::class)]
#[Update(template: '@SyliusUxSemanticUi/crud/update.html.twig', section: 'semantic_ui', resource: 'app.book', provider: GetBookProvider::class)]
#[Index(template: '@SyliusUxSemanticUi/crud/index.html.twig', section: 'semantic_ui', grid: 'app_book', resource: 'app.book')]
#[Delete(section: 'semantic_ui', resource: 'app.book')]
class Book implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[NotBlank]
    private ?String $title = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[NotBlank]
    private ?string $authorName = null;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }
}

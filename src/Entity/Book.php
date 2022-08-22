<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Annotation\DeleteAction;
use Sylius\Component\Resource\Annotation\CreateAction;
use Sylius\Component\Resource\Annotation\IndexAction;
use Sylius\Component\Resource\Annotation\UpdateAction;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[CreateAction(template: '@SyliusUxSemanticUi/crud/create.html.twig', section: 'semantic_ui', resource: 'app.book')]
#[UpdateAction(template: '@SyliusUxSemanticUi/crud/update.html.twig', section: 'semantic_ui', resource: 'app.book')]
#[IndexAction(template: '@SyliusUxSemanticUi/crud/index.html.twig', section: 'semantic_ui', grid: 'app_book', resource: 'app.book')]
#[DeleteAction(section: 'semantic_ui', resource: 'app.book')]
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

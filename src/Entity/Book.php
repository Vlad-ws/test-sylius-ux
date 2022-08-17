<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Action\PlaceHolderAction;
use Sylius\Component\Resource\Annotation\SyliusCrudRoutes;
use Sylius\Component\Resource\Annotation\SyliusRoute;
use Sylius\Component\Resource\Doctrine\ORM\State\CollectionProvider;
use Sylius\Component\Resource\Doctrine\ORM\State\ItemProvider;
use Sylius\Component\Resource\Model\ResourceInterface;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[SyliusRoute(
    name: 'app_semantic_ui_book_create',
    path: 'admin/semantic_ui/books/new',
    methods: ['GET', 'POST'],
    controller: PlaceHolderAction::class,
    template: '@SyliusUxSemanticUi/crud/create.html.twig',
    priority: 20,
    section: 'semantic_ui',
    resource: 'app.book',
    operation: 'create',
    provider: ItemProvider::class
)]
#[SyliusRoute(
    name: 'app_semantic_ui_book_update',
    path: 'admin/semantic_ui/books/{id}/edit',
    methods: ['GET', 'PUT'],
    controller: PlaceHolderAction::class,
    template: '@SyliusUxSemanticUi/crud/update.html.twig',
    priority: 20,
    section: 'semantic_ui',
    resource: 'app.book',
    operation: 'update',
    provider: ItemProvider::class
)]
#[SyliusCrudRoutes(
    alias: 'app.book',
    path: 'admin/semantic_ui/books',
    section: 'semantic_ui',
    redirect: 'update',
    templates: '@SyliusUxSemanticUi/crud',
    grid: 'app_book',
    except: ['index', 'create', 'update'],
)]
#[SyliusRoute(
    name: 'app_semantic_ui_book_index',
    path: 'admin/semantic_ui/books',
    controller: PlaceHolderAction::class,
    template: '@SyliusUxSemanticUi/crud/index.html.twig',
    section: 'semantic_ui',
    grid: 'app_book',
    resource: 'app.book',
    operation: 'index',
    provider: CollectionProvider::class
)]
class Book implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?String $title = null;

    #[ORM\Column(type: 'string', length: 255)]
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

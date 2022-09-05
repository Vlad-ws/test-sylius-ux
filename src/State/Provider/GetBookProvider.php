<?php

declare(strict_types=1);

namespace App\State\Provider;

use App\Entity\Book;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetBookProvider implements ProviderInterface
{
    public function __construct()
    {
    }

    public function provide(Operation $operation, RequestConfiguration $configuration): Book
    {
        $bookId = $configuration->getRequest()->attributes->getInt('id');

        return $this->getBook($bookId);
    }

    private function getBook(int $bookId): Book
    {
        [$id, $title, $authorName] = $this->getDataFromFile($bookId);
        $book = new Book((int) $id);
        $book->setTitle($title);
        $book->setAuthorName($authorName);

        return $book;
    }

    private function getDataFromFile(int $bookId): array
    {
        $filename = sys_get_temp_dir().'/books.csv';
        $f = fopen($filename, 'r');

        if ($f === false) {
            die('Error opening the file ' . $filename);
        }

        while (($row = fgetcsv($f)) !== false) {
            if ($bookId == (int) $row[0] ) {
                fclose($f);

                return $row;
            }
        }

        fclose($f);

        throw new NotFoundHttpException('Not Found');
    }
}

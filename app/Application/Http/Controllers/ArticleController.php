<?php

declare(strict_types=1);

namespace App\Application\Http\Controllers;

use App\Domain\Article\ArticleRepositoryInterface;
use Illuminate\Contracts\View\Factory as ViewFactoryInterface;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ArticleController
{
    private const ERROR_PAGE_NOT_FOUND = 'Article not found';

    public function __construct(
        private readonly ViewFactoryInterface $factory,
        private readonly ArticleRepositoryInterface $articles,
    ) {
    }

    public function index(string $urn): View
    {
        $article = $this->articles->findByUrn($urn);

        if (! $article) {
            throw new NotFoundHttpException(self::ERROR_PAGE_NOT_FOUND);
        }

        return $this->factory->make('page.articles.show', [
            'article' => $this->articles->findByUrn($urn),
        ]);
    }
}

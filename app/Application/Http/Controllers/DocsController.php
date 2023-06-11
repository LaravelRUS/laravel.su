<?php

declare(strict_types=1);

namespace App\Application\Http\Controllers;

use App\Domain\Documentation\DocumentationRepositoryInterface;
use App\Domain\Documentation\Version;
use Illuminate\Contracts\View\Factory as ViewFactoryInterface;
use Illuminate\Contracts\View\View as ViewInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class DocsController
{
    private const ERROR_PAGE_NOT_FOUND = 'Documentation page %s not found';

    private const ERROR_MENU_NOT_FOUND = 'Menu for framework version %s not found';

    public function __construct(
        private ViewFactoryInterface $views,
        private DocumentationRepositoryInterface $docs,
    ) {
    }

    public function show(Version $current, string $version, string $page): ViewInterface
    {
        if (! $document = $this->docs->findByVersionAndUrn($current, $page)) {
            throw new NotFoundHttpException(\sprintf(self::ERROR_PAGE_NOT_FOUND, $page));
        }

        if (! $menu = $this->docs->findByVersionAndUrn($current, $current->menuPage)) {
            throw new NotFoundHttpException(\sprintf(self::ERROR_MENU_NOT_FOUND, $page));
        }

        return $this->views->make('page.docs.show', [
            'version' => $current,
            'menu'    => $menu,
            'page'    => $document,
        ]);
    }

    public function index(Redirector $redirector, Version $current): RedirectResponse
    {
        return $redirector->route('docs.show', [
            $current->name,
            $current->defaultPage,
        ]);
    }
}

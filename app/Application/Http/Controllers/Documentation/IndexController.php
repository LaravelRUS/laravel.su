<?php

declare(strict_types=1);

namespace App\Application\Http\Controllers\Documentation;

use App\Domain\Documentation\Version;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

final readonly class IndexController
{
    public function __invoke(Redirector $redirector, Version $current): RedirectResponse
    {
        return $redirector->route('docs.show', [
            $current->name,
            $current->defaultPage,
        ]);
    }
}

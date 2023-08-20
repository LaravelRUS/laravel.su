<?php

declare(strict_types=1);

namespace App\Application\Http\Controllers\Status;

use App\Domain\Documentation\VersionRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

final readonly class IndexController
{
    public function __construct(
        private VersionRepositoryInterface $versions,
    ) {
    }

    public function __invoke(Redirector $redirector): RedirectResponse
    {
        return $redirector->route('status.show', [
            'version' => $this->versions->last()->name,
        ]);
    }
}

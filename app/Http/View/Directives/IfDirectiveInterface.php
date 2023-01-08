<?php

declare(strict_types=1);

namespace App\Http\View\Directives;

interface IfDirectiveInterface extends DirectiveInterface
{
    /**
     * @param mixed ...$args
     * @return bool
     */
    public function match(mixed ...$args): bool;
}

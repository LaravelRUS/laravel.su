<?php

declare(strict_types=1);

namespace App\Http\View\Directives;

interface GeneratedDirectiveInterface extends DirectiveInterface
{
    /**
     * @param string $expression
     * @return string
     */
    public function generate(string $expression): string;
}

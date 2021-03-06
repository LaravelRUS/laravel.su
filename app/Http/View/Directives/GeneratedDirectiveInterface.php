<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Http\View\Directives;

/**
 * Interface GeneratedDirectiveInterface
 */
interface GeneratedDirectiveInterface extends DirectiveInterface
{
    /**
     * @param string $expression
     * @return string
     */
    public function generate(string $expression): string;
}

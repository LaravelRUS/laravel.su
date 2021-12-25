<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\GitHub;

use Illuminate\Support\Enumerable;

interface RepositoryInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getUser(): string;

    /**
     * @return Enumerable|BranchInterface[]
     */
    public function getBranches(): Enumerable;
}

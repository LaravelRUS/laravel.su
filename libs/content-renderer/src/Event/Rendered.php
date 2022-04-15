<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\ContentRenderer\Event;

use App\ContentRenderer\ResultInterface;

class Rendered extends ContentEvent
{
    /**
     * @param string $content
     * @param ResultInterface $result
     */
    public function __construct(
        string $content,
        private readonly ResultInterface $result
    ) {
        parent::__construct($content);
    }

    /**
     * @return ResultInterface
     */
    public function getResult(): ResultInterface
    {
        return $this->result;
    }
}

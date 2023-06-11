<?php

declare(strict_types=1);

namespace App\Application\Console\Commands;

use Illuminate\Console\Command as BaseCommand;
use Symfony\Component\Console\Helper\ProgressBar;

abstract class Command extends BaseCommand
{
    /**
     * @param int<0, max> $max
     */
    protected function progress(int $max = 0): ProgressBar
    {
        $progress = $this->getOutput()->createProgressBar($max);
        $progress->setFormat('%current%/%max% [%bar%] %percent:3s%% %message%');

        return $progress;
    }

    /**
     * @return int<0, max>
     */
    protected function count(iterable $items): int
    {
        if ($items instanceof \Countable || \is_array($items)) {
            return \count($items);
        }

        return \count([...$items]);
    }
}

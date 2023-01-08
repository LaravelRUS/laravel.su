<?php

declare(strict_types=1);

namespace App\Entity\Documentation\Translation;

enum Status: int
{
    /**
     * Перевод отсутсвует
     */
    case MISSING = 0x00;

    /**
     * Перевод актуален
     */
    case ACTUAL = 0x01;

    /**
     * Перевод немного отстаёт
     */
    case BEHIND = 0x02;

    /**
     * Перевод сильно отстаёт
     */
    case FAR_BEHIND = 0x03;
}

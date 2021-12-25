<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity\Common;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * @mixin ProvidesUpdatedAt
 */
trait UpdatedAtTrait
{
    /**
     * @var Carbon|null
     */
    #[ORM\Column(name: 'updated_at', type: 'carbon', nullable: true)]
    protected ?Carbon $updated = null;

    /**
     * @return Carbon|null
     */
    public function updatedAt(): ?Carbon
    {
        return $this->updated;
    }

    /**
     * @param \DateTimeInterface|null $now
     * @return ProvidesUpdatedAt
     */
    public function touch(\DateTimeInterface $now = null): ProvidesUpdatedAt
    {
        $this->updated = $now ?? Carbon::now();

        return $this;
    }

    /**
     * @return void
     */
    #[ORM\PrePersist]
    public function onPrePersistUpdatedField(): void
    {
        $this->touch();
    }

    /**
     * @return void
     */
    #[ORM\PreUpdate]
    public function onPreUpdateUpdatedField(): void
    {
        $this->touch();
    }
}

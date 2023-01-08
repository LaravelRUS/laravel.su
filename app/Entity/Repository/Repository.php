<?php

declare(strict_types=1);

namespace App\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepositoryTrait;
use Illuminate\Support\Collection;

/**
 * @template T of object
 * @template-extends EntityRepository<T>
 */
abstract class Repository extends EntityRepository
{
    use EntitySpecificationRepositoryTrait;

    /**
     * @return Collection<array-key, T>
     */
    public function all(): Collection
    {
        return Collection::make($this->findAll());
    }
}

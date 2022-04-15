<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity\Documentation\Listener;

use App\ContentRenderer\FactoryInterface;
use App\ContentRenderer\ContentRendererInterface;
use App\ContentRenderer\Type;
use App\Entity\Common\Listener;
use App\Entity\Documentation;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class OnContentRender extends Listener
{
    /**
     * @param FactoryInterface $factory
     */
    public function __construct(
        private readonly FactoryInterface $factory
    ) {
    }

    /**
     * @param Documentation $entity
     * @return ContentRendererInterface
     */
    private function getRendererForSource(Documentation $entity): ContentRendererInterface
    {
        if ($this->isMenu($entity)) {
            return $this->factory->create(Type::MENU);
        }

        return $this->factory->create(Type::DOCUMENTATION);
    }

    /**
     * @param Documentation $entity
     * @return ContentRendererInterface
     */
    private function getRendererForTranslation(Documentation $entity): ContentRendererInterface
    {
        if ($this->isMenu($entity)) {
            return $this->factory->create(Type::MENU);
        }

        return $this->factory->create(Type::TRANSLATION);
    }

    /**
     * @param Documentation $entity
     * @return bool
     */
    private function isMenu(Documentation $entity): bool
    {
        $version = $entity->version;

        return $version->menuPage === $entity->urn;
    }

    /**
     * @param LifecycleEventArgs $e
     * @return void
     */
    public function prePersist(LifecycleEventArgs $e): void
    {
        $this->on($e, Documentation::class, function (Documentation $entity): void {
            $entity->translation->renderWithVersion(
                $entity->version,
                $this->getRendererForTranslation($entity),
            );

            $entity->source->renderWithVersion(
                $entity->version,
                $this->getRendererForSource($entity),
            );
        });
    }

    /**
     * @param PreUpdateEventArgs $e
     * @return void
     */
    public function preUpdate(PreUpdateEventArgs $e): void
    {
        $this->on($e, Documentation::class, function (Documentation $entity) use ($e) {
            if ($e->hasChangedField('translation.source') || ! $entity->translation->isRendered()) {
                $entity->translation->renderWithVersion(
                    $entity->version,
                    $this->getRendererForTranslation($entity),
                );
            }

            if ($e->hasChangedField('content.source') || ! $entity->source->isRendered()) {
                $entity->source->renderWithVersion(
                    $entity->version,
                    $this->getRendererForSource($entity),
                );
            }
        });
    }
}

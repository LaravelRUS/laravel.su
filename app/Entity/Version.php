<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Repository\VersionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'versions')]
#[ORM\Entity(repositoryClass: VersionsRepository::class)]
class Version extends BaseEntity
{
    /**
     * @var non-empty-string
     */
    private const DEFAULT_MENU_PAGE = 'documentation';

    /**
     * @var non-empty-string
     */
    private const DEFAULT_PAGE = 'installation';

    /**
     * @var non-empty-string
     */
    #[ORM\Column(name: 'title', type: 'string', length: 191)]
    public string $name;

    /**
     * @var Collection<array-key, Documentation>
     */
    #[ORM\OneToMany(mappedBy: 'version', targetEntity: Documentation::class, cascade: ['persist', 'merge'])]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'version_id')]
    public iterable $docs;

    /**
     * @var non-empty-string
     */
    #[ORM\Column(name: 'default_page', type: 'string', length: 191)]
    public string $defaultPage = self::DEFAULT_PAGE;

    /**
     * @var non-empty-string
     */
    #[ORM\Column(name: 'menu_page', type: 'string', length: 191)]
    public string $menuPage = self::DEFAULT_MENU_PAGE;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'is_documented', type: 'boolean')]
    public bool $isDocumented = false;

    /**
     * @param non-empty-string $title
     */
    public function __construct(string $title)
    {
        $this->name = \trim($title);
        $this->docs = new ArrayCollection();
    }
}

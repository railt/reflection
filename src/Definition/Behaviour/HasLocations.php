<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesLocations;
use Railt\Reflection\Contracts\Definition\Dependent\DirectiveLocation;

/**
 * Trait HasLocations
 */
trait HasLocations
{
    /**
     * @var array|DirectiveLocation[]
     */
    protected $locations = [];

    /**
     * @return iterable|DirectiveLocation[]
     */
    public function getLocations(): iterable
    {
        return \array_values($this->locations);
    }

    /**
     * @param string $name
     * @return null|DirectiveLocation
     */
    public function getLocation(string $name): ?DirectiveLocation
    {
        return $this->locations[$name] ?? null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasLocation(string $name): bool
    {
        return isset($this->locations[$name]);
    }

    /**
     * @param DirectiveLocation ...$locations
     * @return ProvidesLocations|$this
     */
    public function withLocation(DirectiveLocation ...$locations): ProvidesLocations
    {
        foreach ($locations as $location) {
            $this->locations[$location->getName()] = $location;
        }

        return $this;
    }
}

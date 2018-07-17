<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Dependent\DirectiveLocation;

/**
 * Interface ProvidesLocations
 */
interface ProvidesLocations
{
    /**
     * @return iterable|DirectiveLocation[]
     */
    public function getLocations(): iterable;

    /**
     * @param string $name
     * @return DirectiveLocation|null
     */
    public function getLocation(string $name): ?DirectiveLocation;

    /**
     * @param string $name
     * @return bool
     */
    public function hasLocation(string $name): bool;
}

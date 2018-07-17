<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\SchemaDefinition;

/**
 * Interface ProvidesSchema
 */
interface ProvidesSchema
{
    /**
     * An entity can contain a root api element, which is represented as a Schema object.
     *
     * @param string|null $name
     * @return null|SchemaDefinition
     */
    public function getSchema(string $name = null): ?SchemaDefinition;
}

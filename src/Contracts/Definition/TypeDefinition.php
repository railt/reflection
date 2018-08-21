<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition;

use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Contracts\Definition\Behaviour\Deprecatable;
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesInheritance;
use Railt\Reflection\Contracts\Invocation\Behaviour\ProvidesDirectives;
use Railt\Reflection\Contracts\Definition\Behaviour\Nameable;

/**
 * Interface TypeDefinition
 */
interface TypeDefinition extends Deprecatable, Nameable, ProvidesDirectives, ProvidesInheritance, Definition
{
    /**
     * Returns a short description of definition.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Returns true if the type definition is built-in.
     *
     * @return bool
     */
    public function isBuiltin(): bool;
}

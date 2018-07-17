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
use Railt\Reflection\Contracts\Invocation\Behaviour\ProvidesDirectives;

/**
 * Interface TypeDefinition
 */
interface TypeDefinition extends Deprecatable, ProvidesDirectives, Definition
{
    /**
     * Returns the name of definition instance.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns a short description of definition.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param TypeDefinition $definition
     * @return bool
     */
    public function instanceOf(TypeDefinition $definition): bool;
}

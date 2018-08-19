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

/**
 * Interface TypeDefinition
 */
interface TypeDefinition extends Deprecatable, ProvidesDirectives, ProvidesInheritance, Definition
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
     * Returns true when a type can be rendered as a JSON
     * value or a structure, and they can also be operated
     * on in the GraphQL query.
     *
     * @return bool
     */
    public function isRenderable(): bool;

    /**
     * Returns true in the event that the type can be represented
     * as a value and passed as an argument to the GraphQL request.
     *
     * @return bool
     */
    public function isInputable(): bool;

    /**
     * Returns true if the type definition is built-in.
     *
     * @return bool
     */
    public function isBuiltin(): bool;
}

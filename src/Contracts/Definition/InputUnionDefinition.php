<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeDefinitions;

/**
 * Interface InputUnionDefinition
 * @internal Experimental support: https://github.com/facebook/graphql/pull/395
 */
interface InputUnionDefinition extends ProvidesTypeDefinitions, TypeDefinition
{
}

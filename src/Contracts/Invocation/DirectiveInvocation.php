<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Invocation;

use Railt\Reflection\Contracts\Definition\DirectiveDefinition;
use Railt\Reflection\Contracts\Invocation\Behaviour\ProvidesPassedArguments;

/**
 * Interface DirectiveInvocation
 * @method DirectiveDefinition getDefinition()
 */
interface DirectiveInvocation extends ProvidesPassedArguments, TypeInvocation
{
}

<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation;

use Railt\Reflection\AbstractTypeInvocation;
use Railt\Reflection\Contracts\Invocation\DirectiveInvocation as DirectiveInvocationInterface;
use Railt\Reflection\Contracts\TypeInterface;
use Railt\Reflection\Definition\DirectiveDefinition;
use Railt\Reflection\Invocation\Behaviour\HasArguments;

/**
 * Class DirectiveInvocation
 */
class DirectiveInvocation extends AbstractTypeInvocation implements DirectiveInvocationInterface
{
    use HasArguments;

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return DirectiveDefinition::getType();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '@' . parent::__toString();
    }
}

<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation;

use Railt\Reflection\Contracts\Invocation\DirectiveInvocation as DirectiveInvocationInterface;
use Railt\Reflection\Contracts\Type;
use Railt\Reflection\Definition\DirectiveDefinition;
use Railt\Reflection\Invocation\Behaviour\HasPassedArguments;

/**
 * Class DirectiveInvocation
 */
class DirectiveInvocation extends AbstractTypeInvocation implements DirectiveInvocationInterface
{
    use HasPassedArguments;

    /**
     * @return Type
     */
    public static function getType(): Type
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

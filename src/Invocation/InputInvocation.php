<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation;

use Railt\Reflection\Contracts\Invocation\InputInvocation as InputInvocationInterface;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Invocation\Behaviour\HasArguments;
use Railt\Reflection\Type;

/**
 * Class InputInvocation
 */
class InputInvocation extends AbstractTypeInvocation implements InputInvocationInterface
{
    use HasArguments;
    
    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::INPUT_OBJECT);
    }
}

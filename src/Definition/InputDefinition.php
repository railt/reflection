<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition;

use Railt\Reflection\AbstractTypeDefinition;
use Railt\Reflection\Contracts\TypeInterface as TypeInterface;
use Railt\Reflection\Contracts\Definition\InputDefinition as InputDefinitionInterface;
use Railt\Reflection\Definition\Behaviour\HasInputFields;
use Railt\Reflection\Type;

/**
 * Class InputDefinition
 */
class InputDefinition extends AbstractTypeDefinition implements InputDefinitionInterface
{
    use HasInputFields;

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::INPUT_OBJECT);
    }
}

<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Dependent;

use Railt\Reflection\Contracts\Definition\Dependent\FieldDefinition as FieldDefinitionInterface;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Type;

/**
 * Class FieldDefinition
 */
class FieldDefinition extends AbstractDependentTypeDefinition implements FieldDefinitionInterface
{
    public static function getType(): TypeInterface
    {
        return Type::of(Type::FIELD);
    }


}

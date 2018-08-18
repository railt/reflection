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
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\TypeInterface as TypeInterface;
use Railt\Reflection\Definition\Behaviour\HasArguments;
use Railt\Reflection\Definition\Behaviour\HasTypeIndication;
use Railt\Reflection\Type;

/**
 * Class FieldDefinition
 */
class FieldDefinition extends AbstractDependentTypeDefinition implements FieldDefinitionInterface
{
    use HasTypeIndication;
    use HasArguments;

    /**
     * FieldDefinition constructor.
     * @param TypeDefinition $parent
     * @param string $name
     * @param string $type
     */
    public function __construct(TypeDefinition $parent, string $name, string $type)
    {
        parent::__construct($parent, $name);

        $this->withTypeDefinition($type);
    }

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::FIELD);
    }
}

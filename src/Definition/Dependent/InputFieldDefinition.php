<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Dependent;

use Railt\Reflection\Contracts\Definition\Dependent\InputFieldDefinition as InputFieldDefinitionInterface;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Definition\Behaviour\HasDefaultValue;
use Railt\Reflection\Definition\Behaviour\HasTypeIndication;
use Railt\Reflection\Type;

/**
 * Class InputFieldDefinition
 */
class InputFieldDefinition extends AbstractDependentTypeDefinition implements InputFieldDefinitionInterface
{
    use HasTypeIndication;
    use HasDefaultValue;

    /**
     * ArgumentDefinition constructor.
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
        return Type::of(Type::INPUT_FIELD_DEFINITION);
    }
}

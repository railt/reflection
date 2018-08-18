<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Dependent;

use Railt\Reflection\Contracts\Definition\Dependent\EnumValueDefinition as EnumValueDefinitionInterface;
use Railt\Reflection\Contracts\TypeInterface as TypeInterface;
use Railt\Reflection\Type;

/**
 * Class EnumValueDefinition
 */
class EnumValueDefinition extends AbstractDependentTypeDefinition implements EnumValueDefinitionInterface
{
    /**
     * @var string|null
     */
    protected $value;

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::ENUM_VALUE);
    }

    /**
     * @return string|mixed
     */
    public function getValue()
    {
        return $this->value ?? $this->getName();
    }

    /**
     * @param mixed $value
     * @return EnumValueDefinitionInterface|$this
     */
    public function withValue($value): EnumValueDefinitionInterface
    {
        $this->value = $value;

        return $this;
    }
}

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
use Railt\Reflection\Contracts\Type as TypeInterface;
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
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::ENUM_VALUE);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value ?? $this->getName();
    }

    /**
     * @param null|string $value
     * @return EnumValueDefinitionInterface|$this
     */
    public function withValue(?string $value): EnumValueDefinitionInterface
    {
        $this->value = $value;

        return $this;
    }
}

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
use Railt\Reflection\Contracts\Definition\ScalarDefinition as ScalarDefinitionInterface;
use Railt\Reflection\Contracts\TypeInterface;
use Railt\Reflection\Type;

/**
 * Class ScalarDefinition
 */
class ScalarDefinition extends AbstractTypeDefinition implements ScalarDefinitionInterface
{
    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::SCALAR);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function parse($value)
    {
        /** @var ScalarDefinitionInterface $parent */
        if ($parent = $this->getInheritedParent()) {
            $value = $parent->parse($value);
        }

        return $value;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        /** @var ScalarDefinitionInterface $parent */
        if ($parent = $this->getInheritedParent()) {
            $value = $parent->serialize($value);
        }

        return $value;
    }
}

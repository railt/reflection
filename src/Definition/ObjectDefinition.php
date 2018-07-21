<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition;

use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Type;

/**
 * Class ObjectDefinition
 */
class ObjectDefinition extends InterfaceDefinition
{
    /**
     * @return TypeInterface
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::OBJECT);
    }
}

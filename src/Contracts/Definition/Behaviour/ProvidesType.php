<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\TypeInterface;

/**
 * Interface ProvidesType
 */
interface ProvidesType
{
    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface;

    /**
     * @param TypeInterface|string $type
     * @return bool
     */
    public static function typeOf($type): bool;
}

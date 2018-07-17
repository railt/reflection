<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Type;

/**
 * Interface ProvidesType
 */
interface ProvidesType
{
    /**
     * @return Type
     */
    public static function getType(): Type;

    /**
     * @param Type $type
     * @return bool
     */
    public function typeOf(Type $type): bool;
}

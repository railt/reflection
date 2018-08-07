<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition;

/**
 * Interface ScalarDefinition
 */
interface ScalarDefinition extends TypeDefinition
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function parse($value);

    /**
     * @param mixed $value
     * @return mixed
     */
    public function serialize($value);
}

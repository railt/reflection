<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Common;

/**
 * Class Renderer
 */
class Renderer
{
    /**
     * @param string $name
     * @return string
     */
    public static function typeName(string $name): string
    {
        $name = \ucwords(\mb_strtolower(\preg_replace('/\W+/u', ' ', $name)));

        return (string)\str_replace(' ', '', $name);
    }

    /**
     * @param iterable|string[] $names
     * @return string
     */
    public static function oneOf(iterable $names): string
    {
        $result = \implode(', ', $names instanceof \Traversable ? \iterator_to_array($names) : $names);

        if (($position = \strrpos($result, ', ')) !== false) {
            return \substr_replace($result, ' or ', $position, 2);
        }

        return $result;
    }
}

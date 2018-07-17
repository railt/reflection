<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts;

/**
 * Interface Type
 */
interface Type
{
    /**
     * Type of document (global).
     */
    public const DOCUMENT = 'DOCUMENT';

    /**
     * Type of enum definition.
     */
    public const ENUM = 'ENUM';

    /**
     * Location adjacent to a query operation.
     */
    public const QUERY = 'QUERY';

    /**
     * Location adjacent to a union definition.
     */
    public const UNION = 'UNION';

    /**
     * Location adjacent to a field.
     */
    public const FIELD = 'FIELD';

    /**
     * Location adjacent to a scalar definition.
     */
    public const SCALAR = 'SCALAR';

    /**
     * Location adjacent to a schema definition.
     */
    public const SCHEMA = 'SCHEMA';

    /**
     * Type of object type definition.
     */
    public const OBJECT = 'OBJECT';

    /**
     * Location adjacent to a mutation operation.
     */
    public const MUTATION = 'MUTATION';

    /**
     * Type of interface definition.
     */
    public const INTERFACE = 'INTERFACE';

    /**
     * Type of enum value definition.
     */
    public const ENUM_VALUE = 'ENUM_VALUE';

    /**
     * Type of input object type definition.
     */
    public const INPUT_OBJECT = 'INPUT_OBJECT';

    /**
     * Type of input union object type definition.
     */
    public const INPUT_UNION = 'INPUT_UNION';

    /**
     * Location adjacent to a subscription operation.
     */
    public const SUBSCRIPTION = 'SUBSCRIPTION';

    /**
     * Location adjacent to a fragment spread.
     */
    public const FRAGMENT_SPREAD = 'FRAGMENT_SPREAD';

    /**
     * Type of inline fragment.
     */
    public const INLINE_FRAGMENT = 'INLINE_FRAGMENT';

    /**
     * Location adjacent to a field definition.
     */
    public const FIELD_DEFINITION = 'FIELD_DEFINITION';

    /**
     * Location adjacent to a fragment definition.
     */
    public const FRAGMENT_DEFINITION = 'FRAGMENT_DEFINITION';

    /**
     * Type of argument definition.
     */
    public const ARGUMENT_DEFINITION = 'ARGUMENT_DEFINITION';

    /**
     * Type of input object field definition.
     */
    public const INPUT_FIELD_DEFINITION = 'INPUT_FIELD_DEFINITION';

    /**
     * Type of directive definition.
     */
    public const DIRECTIVE = 'DIRECTIVE';

    /**
     * @param string $name
     * @return bool
     */
    public static function isValid(string $name): bool;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param Type $type
     * @return bool
     */
    public function instanceOf(Type $type): bool;

    /**
     * @return string
     */
    public function __toString(): string;
}

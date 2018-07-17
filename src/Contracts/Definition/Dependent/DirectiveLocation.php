<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Dependent;

use Railt\Reflection\Contracts\Type;

/**
 * Interface DirectiveLocation
 */
interface DirectiveLocation
{
    /**
     * Locations using in graphql queries
     */
    public const TARGET_GRAPHQL_QUERY = [
        Type::FIELD,
        Type::QUERY,
        Type::MUTATION,
        Type::SUBSCRIPTION,
        Type::FRAGMENT_DEFINITION,
        Type::FRAGMENT_SPREAD,
        Type::INLINE_FRAGMENT,
    ];

    /**
     * Locations using in graphql schema definitions
     */
    public const TARGET_GRAPHQL_SDL = [
        Type::SCHEMA,
        Type::OBJECT,
        Type::INPUT_OBJECT,
        Type::INPUT_FIELD_DEFINITION,
        Type::ENUM,
        Type::ENUM_VALUE,
        Type::UNION,
        Type::INPUT_UNION,
        Type::INTERFACE,
        Type::SCALAR,
        Type::FIELD_DEFINITION,
        Type::ARGUMENT_DEFINITION,
        Type::DOCUMENT,
    ];

    /**
     * @return bool
     */
    public function isPublic(): bool;

    /**
     * @return bool
     */
    public function isPrivate(): bool;

    /**
     * @param Type $type
     * @return bool
     */
    public function isAllowedFor(Type $type): bool;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function __toString(): string;
}

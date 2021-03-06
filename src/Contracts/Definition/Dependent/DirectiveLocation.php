<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Dependent;

use Railt\Reflection\Contracts\TypeInterface;

/**
 * Interface DirectiveLocation
 */
interface DirectiveLocation extends DependentTypeDefinition
{
    /**
     * @version SDL June 2018
     * @var string
     */
    public const QUERY = 'QUERY';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const MUTATION = 'MUTATION';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const SUBSCRIPTION = 'SUBSCRIPTION';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const FIELD = 'FIELD';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const FRAGMENT_DEFINITION = 'FRAGMENT_DEFINITION';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const FRAGMENT_SPREAD = 'FRAGMENT_SPREAD';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const INLINE_FRAGMENT = 'INLINE_FRAGMENT';

    /**
     * @version RL/SDL
     * @var string
     */
    public const DOCUMENT = 'DOCUMENT';

    /**
     * @version RL/SDL
     * @var string
     */
    public const ANY = 'ANY';

    /**
     * @version SDL Draft Specification
     * @var string
     */
    public const INPUT_UNION = 'INPUT_UNION';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const SCHEMA = 'SCHEMA';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const SCALAR = 'SCALAR';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const OBJECT = 'OBJECT';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const FIELD_DEFINITION = 'FIELD_DEFINITION';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const ARGUMENT_DEFINITION = 'ARGUMENT_DEFINITION';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const INTERFACE           = 'INTERFACE';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const UNION = 'UNION';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const ENUM = 'ENUM';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const ENUM_VALUE = 'ENUM_VALUE';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const INPUT_OBJECT = 'INPUT_OBJECT';

    /**
     * @version SDL June 2018
     * @var string
     */
    public const INPUT_FIELD_DEFINITION = 'INPUT_FIELD_DEFINITION';

    /**
     * Locations using in graphql queries
     */
    public const EXECUTABLE_LOCATIONS = [
        self::QUERY,
        self::MUTATION,
        self::SUBSCRIPTION,
        self::FIELD,
        self::FRAGMENT_DEFINITION,
        self::FRAGMENT_SPREAD,
        self::INLINE_FRAGMENT,
    ];

    /**
     * Locations using in graphql schema definitions
     */
    public const SDL_LOCATIONS = [
        self::SCALAR,
        self::OBJECT,
        self::INTERFACE,
        self::UNION,
        self::ENUM,
        self::INPUT_OBJECT,
        self::INPUT_UNION,
        self::SCHEMA,
        self::ENUM_VALUE,
        self::FIELD_DEFINITION,
        self::ARGUMENT_DEFINITION,
        self::INPUT_FIELD_DEFINITION,
        self::DOCUMENT,
    ];

    /**
     * @var string[]
     */
    public const LOCATION_TO_TYPES = [
        self::SCALAR                 => TypeInterface::SCALAR,
        self::OBJECT                 => TypeInterface::OBJECT,
        self::INTERFACE              => TypeInterface::INTERFACE,
        self::UNION                  => TypeInterface::UNION,
        self::ENUM                   => TypeInterface::ENUM,
        self::INPUT_OBJECT           => TypeInterface::INPUT_OBJECT,
        self::INPUT_UNION            => TypeInterface::INPUT_UNION,
        self::SCHEMA                 => TypeInterface::SCHEMA,
        self::ENUM_VALUE             => TypeInterface::ENUM_VALUE,
        self::FIELD_DEFINITION       => TypeInterface::FIELD,
        self::ARGUMENT_DEFINITION    => TypeInterface::ARGUMENT,
        self::INPUT_FIELD_DEFINITION => TypeInterface::INPUT_FIELD_DEFINITION,
        self::DOCUMENT               => TypeInterface::DOCUMENT,
    ];

    /**
     * @return bool
     */
    public function isExecutable(): bool;

    /**
     * @return bool
     */
    public function isPrivate(): bool;

    /**
     * @param TypeInterface $type
     * @return bool
     */
    public function isAllowedFor(TypeInterface $type): bool;
}

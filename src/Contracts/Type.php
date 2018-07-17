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
     * @var string
     */
    public const SCALAR = 'Scalar';

    /**
     * @var string
     */
    public const OBJECT = 'Object';

    /**
     * @var string
     */
    public const INTERFACE = 'Interface';

    /**
     * @var string
     */
    public const UNION = 'Union';

    /**
     * @var string
     */
    public const ENUM = 'Enum';

    /**
     * @var string
     */
    public const INPUT_OBJECT = 'Input';

    /**
     * @var string
     */
    public const INPUT_UNION = 'InputUnion';

    /**
     * @var string
     */
    public const SCHEMA = 'Schema';

    /**
     * @var string
     */
    public const ENUM_VALUE = 'EnumValue';

    /**
     * @var string
     */
    public const FIELD_DEFINITION = 'FieldDefinition';

    /**
     * @var string
     */
    public const ARGUMENT_DEFINITION = 'ArgumentDefinition';

    /**
     * @var string
     */
    public const INPUT_FIELD_DEFINITION = 'InputField';

    /**
     * @var string
     */
    public const DOCUMENT = 'Document';

    /**
     * @var string
     */
    public const ANY = 'Any';

    /**
     * @var string[]
     */
    public const DEPENDENT_TYPES = [
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
    public const ROOT_TYPES = [
        self::SCALAR,
        self::OBJECT,
        self::INTERFACE,
        self::UNION,
        self::ENUM,
        self::INPUT_OBJECT,
        self::INPUT_UNION,
        self::ANY,
    ];

    /**
     * @var string[]|array[]
     */
    public const INHERITANCE_TREE = [
        self::ANY => [
            self::INTERFACE => [
                self::OBJECT => [
                    self::INPUT_OBJECT,
                ],
            ],
            self::UNION => [
                self::INPUT_UNION
            ],
            self::SCALAR => [
                self::ENUM
            ]
        ]
    ];

    /**
     * @return bool
     */
    public function isDependent(): bool;

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

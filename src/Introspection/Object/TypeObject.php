<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Introspection\Object;

use Railt\Reflection\Definition\ObjectDefinition;
use Railt\Reflection\Document;

/**
 * Class TypeObject
 */
final class TypeObject extends ObjectDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = '__Type';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'The fundamental unit of any GraphQL Schema is the type. There are
many kinds of types in GraphQL as represented by the __TypeKind enum.

Depending on the kind of a type, certain fields describe information
about that type. Scalar types provide no information beyond a name
and description, while Enum types provide their values. Object and
Interface types provide the fields they describe. Abstract types,
Union and Interface, provide the Object types possible at runtime.
List and NonNull types compose other types.';

    /**
     * @var int
     */
    public const TYPE_LINE = 36;

    /**
     * SchemaObject constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        parent::__construct($document, static::TYPE_NAME);

        $this->withDescription(self::TYPE_DESCRIPTION);
        $this->withLine(self::TYPE_LINE);
    }

    /**
     * @return bool
     */
    public function isBuiltin(): bool
    {
        return true;
    }
}

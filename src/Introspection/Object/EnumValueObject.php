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
 * Class EnumValueObject
 */
class EnumValueObject extends ObjectDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = '__EnumValue';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'One possible value for a given Enum. Enum values are unique values,
not a placeholder for a string or numeric value. However an Enum
value is returned in a JSON response as a string.';

    /**
     * @var int
     */
    public const TYPE_LINE = 83;

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
}

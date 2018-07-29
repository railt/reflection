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
 * Class FieldObject
 */
class FieldObject extends ObjectDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = '__Field';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'Object and Interface types are described by a list of Fields, each of
which has a name, potentially a list of arguments, and a return type.';

    /**
     * @var int
     */
    public const TYPE_LINE = 53;

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
<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Introspection\Enum;

use Railt\Reflection\Definition\EnumDefinition;
use Railt\Reflection\Document;

/**
 * Class TypeKindEnum
 */
class TypeKindEnum extends EnumDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = '__TypeKind';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'An enum describing what kind of type a given __Type is.';

    /**
     * @var int
     */
    public const TYPE_LINE = 94;

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

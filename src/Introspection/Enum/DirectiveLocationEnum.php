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
 * Class DirectiveLocationEnum
 */
final class DirectiveLocationEnum extends EnumDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = '__DirectiveLocation';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'A Directive can be adjacent to many parts of the GraphQL language,
a __DirectiveLocation describes one such possible adjacencies.';

    /**
     * @var int
     */
    public const TYPE_LINE = 149;

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

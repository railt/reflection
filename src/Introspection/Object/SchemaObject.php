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
 * Class SchemaObject
 */
class SchemaObject extends ObjectDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = '__Schema';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'A GraphQL Schema defines the capabilities of a GraphQL server.
It exposes all available types and directives on the server, as well
as the entry points for query, mutation, and subscription operations.';

    /**
     * @var int
     */
    public const TYPE_LINE = 7;

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

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
 * Class DirectiveObject
 */
final class DirectiveObject extends ObjectDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = '__Directive';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'A Directive provides a way to describe alternate runtime execution
and type validation behavior in a GraphQL document.

In some cases, you need to provide options to alter GraphQL\'s
execution behavior in ways field arguments will not suffice, such
as conditionally including or skipping a field. Directives provide
this by describing additional information to the executor.';

    /**
     * @var int
     */
    public const TYPE_LINE = 133;

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

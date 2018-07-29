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
 * Class InputValueObject
 */
class InputValueObject extends ObjectDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = '__InputValue';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'Arguments provided to Fields or Directives and the input fields of an
InputObject are represented as Input Values which describe their
type and optionally a default value.';

    /**
     * @var int
     */
    public const TYPE_LINE = 68;

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

<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Stdlib\Scalar;

use Railt\Reflection\Definition\ScalarDefinition;
use Railt\Reflection\Document;
use Railt\Reflection\Exception\TypeConflictException;

/**
 * Class StringScalar
 */
final class StringScalar extends ScalarDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = 'String';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'A UTF‐8 character sequence.';

    /**
     * @var int
     */
    private const DEFINITION_LINE = 12;

    /**
     * BooleanScalar constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        parent::__construct($document, self::TYPE_NAME);

        $this->withDescription(self::TYPE_DESCRIPTION);
        $this->withLine(self::DEFINITION_LINE);
    }

    /**
     * @param mixed $value
     * @return string
     * @throws TypeConflictException
     */
    public function parse($value): string
    {
        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not parse %s type', \gettype($value)));
        }

        return (string)$value;
    }

    /**
     * @param mixed $value
     * @return string
     * @throws TypeConflictException
     */
    public function serialize($value): string
    {
        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not serialize %s type', \gettype($value)));
        }

        return (string)$value;
    }

    /**
     * @return bool
     */
    public function isBuiltin(): bool
    {
        return true;
    }
}

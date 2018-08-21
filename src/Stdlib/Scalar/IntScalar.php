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
 * Class IntScalar
 */
final class IntScalar extends ScalarDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = 'Int';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'A signed 32‐bit integer.';

    /**
     * @var int
     */
    private const DEFINITION_LINE = 4;

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
     * @return int
     * @throws TypeConflictException
     */
    public function parse($value): int
    {
        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not parse %s type', \gettype($value)));
        }

        return (int)parent::parse($value);
    }

    /**
     * @param mixed $value
     * @return int
     * @throws TypeConflictException
     */
    public function serialize($value): int
    {
        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not serialize %s type', \gettype($value)));
        }

        return (int)parent::serialize($value);
    }

    /**
     * @return bool
     */
    public function isBuiltin(): bool
    {
        return true;
    }
}

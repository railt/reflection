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
 * Class BooleanScalar
 */
final class BooleanScalar extends ScalarDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = 'Boolean';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'Rebel or Empire? Nope! true or false.';

    /**
     * @var int
     */
    private const DEFINITION_LINE = 16;

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
     * @return bool
     * @throws TypeConflictException
     */
    public function parse($value): bool
    {
        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not parse %s type', \gettype($value)));
        }

        return (bool)parent::parse($value);
    }

    /**
     * @param mixed $value
     * @return bool
     * @throws TypeConflictException
     */
    public function serialize($value): bool
    {
        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not serialize %s type', \gettype($value)));
        }

        return (bool)parent::serialize($value);
    }

    /**
     * @return bool
     */
    public function isBuiltin(): bool
    {
        return true;
    }
}

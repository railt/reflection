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
 * Class DateTimeScalar
 */
class DateTimeScalar extends ScalarDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = 'DateTime';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'The DateTime scalar conforms to the RFC 3339 profile of the ISO 8601 standard.';

    /**
     * BooleanScalar constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        parent::__construct($document, self::TYPE_NAME);

        $this->withDescription(self::TYPE_DESCRIPTION);
    }

    /**
     * @param mixed $value
     * @return \DateTimeInterface
     * @throws TypeConflictException
     */
    public function parse($value): \DateTimeInterface
    {
        if ($value instanceof \DateTimeInterface) {
            return $value;
        }

        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not parse %s type', \gettype($value)));
        }

        $value = (string)parent::parse($value);

        try {
            return new \DateTime($value);
        } catch (\Throwable $e) {
            throw new TypeConflictException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param mixed $value
     * @return string
     * @throws TypeConflictException
     */
    public function serialize($value): string
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format(\DateTime::RFC3339);
        }

        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not serialize %s type', \gettype($value)));
        }

        $value = parent::parse($value);

        try {
            return (new \DateTime((string)$value))->format(\DateTime::RFC3339);
        } catch (\Throwable $e) {
            throw new TypeConflictException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return 31;
    }
}

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
final class DateTimeScalar extends ScalarDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = 'DateTime';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = <<<Description
            The DateTime scalar conforms to the **RFC 3339** 
            profile of the **ISO 8601** standard.
Description;

    /**
     * @var int
     */
    private const DEFINITION_LINE = 31;

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

        return $this->parseDateTime((string)parent::parse($value));
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

        return $this->parseDateTime((string)$value)
            ->format(\DateTime::RFC3339);
    }

    /**
     * @param string $value
     * @return \DateTimeInterface
     * @throws TypeConflictException
     */
    private function parseDateTime(string $value): \DateTimeInterface
    {
        try {
            return new \DateTime((string)$value, new \DateTimeZone('UTC'));
        } catch (\Throwable $e) {
            $message = \str_replace('DateTime::__construct(): ', '', $e->getMessage());

            throw new TypeConflictException($message, $e->getCode());
        }
    }

    /**
     * @return bool
     */
    public function isBuiltin(): bool
    {
        return true;
    }
}

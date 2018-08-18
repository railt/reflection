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
 * Class IdScalar
 */
final class IdScalar extends ScalarDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = 'ID';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = <<<Description
The ID scalar type represents a unique identifier, often used to refetch 
an object or as the key for a cache. The ID type is serialized in the 
same way as a String; however, defining it as an ID signifies that it 
is not intended to be human‐readable.
Description;

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
     * @return string
     * @throws TypeConflictException
     */
    public function parse($value): string
    {
        if (! \is_scalar($value)) {
            throw new TypeConflictException(\sprintf('Could not parse %s type', \gettype($value)));
        }

        return (string)parent::parse($value);
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

        return (string)parent::serialize($value);
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return 25;
    }

    /**
     * @return bool
     */
    public function isBuiltin(): bool
    {
        return true;
    }
}

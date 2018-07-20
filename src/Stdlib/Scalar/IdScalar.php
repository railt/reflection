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

/**
 * Class IdScalar
 */
class IdScalar extends ScalarDefinition
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
     * @return int
     */
    public function getLine(): int
    {
        return 25;
    }
}

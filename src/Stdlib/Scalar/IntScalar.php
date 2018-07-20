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
 * Class IntScalar
 */
class IntScalar extends ScalarDefinition
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
        return 4;
    }
}

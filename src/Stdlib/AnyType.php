<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Stdlib;

use Railt\Reflection\AbstractTypeDefinition;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Document;
use Railt\Reflection\Type;

/**
 * Class AnyType
 */
class AnyType extends AbstractTypeDefinition
{
    /**
     * @var string
     */
    public const TYPE_NAME = 'Any';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = 'Abstract type, representing any data type';

    /**
     * AnyScalar constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        parent::__construct($document, self::TYPE_NAME);

        $this->withDescription(self::TYPE_DESCRIPTION);
    }

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::ANY);
    }
}

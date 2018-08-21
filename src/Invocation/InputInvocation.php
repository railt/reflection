<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation;

use Railt\Reflection\AbstractTypeInvocation;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Invocation\InputInvocation as InputInvocationInterface;
use Railt\Reflection\Contracts\TypeInterface;
use Railt\Reflection\Document;
use Railt\Reflection\Invocation\Behaviour\HasArguments;
use Railt\Reflection\Type;

/**
 * Class InputInvocation
 */
class InputInvocation extends AbstractTypeInvocation implements InputInvocationInterface
{
    use HasArguments;

    /**
     * InputInvocation constructor.
     * @param Document|DocumentInterface $document
     * @param string|null $name
     */
    public function __construct(Document $document, string $name = null)
    {
        parent::__construct($document, $name);
    }

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::INPUT_OBJECT);
    }
}

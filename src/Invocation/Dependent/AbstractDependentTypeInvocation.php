<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation\Dependent;

use Railt\Reflection\Contracts\Invocation\Dependent\DependentTypeInvocation;
use Railt\Reflection\Contracts\Invocation\TypeInvocation;
use Railt\Reflection\Document;
use Railt\Reflection\Invocation\AbstractTypeInvocation;

/**
 * Class AbstractDependentTypeInvocation
 */
abstract class AbstractDependentTypeInvocation extends AbstractTypeInvocation implements DependentTypeInvocation
{
    /**
     * @var TypeInvocation
     */
    protected $parent;

    /**
     * AbstractDependentTypeInvocation constructor.
     * @param TypeInvocation $parent
     * @param Document $document
     * @param string $name
     */
    public function __construct(TypeInvocation $parent, Document $document, string $name)
    {
        $this->parent = $parent;

        parent::__construct($document, $name);
    }

    /**
     * @return TypeInvocation
     */
    public function getParent(): TypeInvocation
    {
        return $this->parent;
    }
}

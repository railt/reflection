<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Dependent;

use Railt\Reflection\AbstractTypeDefinition;
use Railt\Reflection\Contracts\Definition\Dependent\DependentTypeDefinition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Document;

/**
 * Class AbstractDependentTypeDefinition
 */
abstract class AbstractDependentTypeDefinition extends AbstractTypeDefinition implements DependentTypeDefinition
{
    /**
     * @var TypeDefinition
     */
    protected $parent;

    /**
     * AbstractDependentTypeDefinition constructor.
     * @param TypeDefinition $parent
     * @param Document $document
     * @param string $name
     */
    public function __construct(TypeDefinition $parent, Document $document, string $name)
    {
        $this->parent = $parent;

        parent::__construct($document, $name);
    }

    /**
     * @return TypeDefinition
     */
    public function getParentDefinition(): TypeDefinition
    {
        return $this->parent;
    }
}

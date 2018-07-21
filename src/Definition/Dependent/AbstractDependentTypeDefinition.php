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
     * @param string $name
     */
    public function __construct(TypeDefinition $parent, string $name)
    {
        $this->parent = $parent;

        parent::__construct($parent->getDocument(), $name);
    }

    /**
     * @return TypeDefinition
     */
    public function getParentDefinition(): TypeDefinition
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        try {
            $parent = (string)$this->getParentDefinition();
        } catch (\Throwable $e) {
            $parent = '?<?>';
        }

        return \sprintf('%s of %s', parent::__toString(), $parent);
    }
}

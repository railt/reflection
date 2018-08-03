<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Dictionary;

use Railt\Reflection\Common\Jsonable;
use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Dictionary;
use Railt\Reflection\Contracts\Type;

/**
 * Class ProxyDictionary
 */
class ProxyDictionary implements Dictionary, \JsonSerializable
{
    use Jsonable;
    use Serializable;

    /**
     * @var Dictionary
     */
    protected $proxy;

    /**
     * ProxyDictionary constructor.
     * @param Dictionary $parent
     */
    public function __construct(Dictionary $parent)
    {
        $this->proxy = $parent;
    }

    /**
     * @return Dictionary
     */
    public function getParentDictionary(): Dictionary
    {
        return $this->proxy;
    }

    /**
     * @param Type|null $of
     * @return iterable|TypeDefinition[]
     */
    public function all(Type $of = null): iterable
    {
        foreach ($this->proxy->all($of) as $definition) {
            yield $definition;
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return $this->proxy->has($name);
    }

    /**
     * @param string $name
     * @return null|TypeDefinition
     */
    public function find(string $name): ?TypeDefinition
    {
        return $this->proxy->find($name);
    }

    /**
     * @param string $name
     * @param Definition|null $from
     * @return TypeDefinition
     * @throws \Railt\Reflection\Exception\TypeNotFoundException
     */
    public function get(string $name, Definition $from = null): TypeDefinition
    {
        return $this->proxy->get($name, $from);
    }

    /**
     * @param TypeDefinition $type
     * @return Dictionary
     */
    public function add(TypeDefinition $type): Dictionary
    {
        return $this->proxy->add($type);
    }
}

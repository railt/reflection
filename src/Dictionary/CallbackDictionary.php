<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Dictionary;

use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;

/**
 * Class CallbackDictionary
 */
class CallbackDictionary extends SimpleDictionary
{
    /**
     * @var array|\Closure[]
     */
    private $callbacks = [];

    /**
     * @param \Closure $then
     */
    public function onTypeNotFound(\Closure $then): void
    {
        $this->callbacks[] = $then;
    }

    /**
     * @param string $name
     * @param Definition|null $from
     * @return TypeDefinition
     * @throws \Railt\Reflection\Exception\TypeNotFoundException
     */
    public function get(string $name, Definition $from = null): TypeDefinition
    {
        $this->invoke($name, $from);

        return parent::get($name, $from);
    }

    /**
     * @param string $name
     * @param Definition|null $from
     */
    private function invoke(string $name, Definition $from = null): void
    {
        foreach ($this->callbacks as $callback) {
            if (! $this->has($name)) {
                $callback($name, $from, function (TypeDefinition $type): void {
                    $this->add($type);
                });
            }
        }
    }

    /**
     * @param string $name
     * @return null|TypeDefinition
     */
    public function find(string $name): ?TypeDefinition
    {
        return parent::find($name);
    }
}

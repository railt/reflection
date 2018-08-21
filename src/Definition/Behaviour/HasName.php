<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\Nameable;

/**
 * Trait HasName
 */
trait HasName
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        if ($this->name === null) {
            return \spl_object_hash($this) . '@anonymous';
        }

        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Nameable|$this
     */
    public function renameTo(?string $name): Nameable
    {
        $this->name = $name;

        return $this;
    }
}

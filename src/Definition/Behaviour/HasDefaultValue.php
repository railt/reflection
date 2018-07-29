<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesDefaultValue;

/**
 * Trait HasDefaultValue
 */
trait HasDefaultValue
{
    /**
     * @var mixed
     */
    protected $defaultValue;

    /**
     * @var bool
     */
    protected $hasDefaultValue = false;

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $value
     * @return ProvidesDefaultValue|$this
     */
    public function withDefaultValue($value): ProvidesDefaultValue
    {
        $this->defaultValue = $value;
        $this->hasDefaultValue = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDefaultValue(): bool
    {
        return $this->hasDefaultValue;
    }

    /**
     * @return ProvidesDefaultValue|$this
     */
    public function withoutDefaultValue(): ProvidesDefaultValue
    {
        $this->defaultValue = null;
        $this->hasDefaultValue = false;

        return $this;
    }
}

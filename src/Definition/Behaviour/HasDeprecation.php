<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\Deprecatable;

/**
 * Trait HasDeprecation
 * @mixin Deprecatable
 */
trait HasDeprecation
{
    /**
     * @var string|null
     */
    protected $deprecation;

    /**
     * @return bool
     */
    public function isDeprecated(): bool
    {
        return $this->deprecation !== null;
    }

    /**
     * @param null|string $reason
     * @return Deprecatable|$this
     */
    public function withDeprecationReason(?string $reason): Deprecatable
    {
        $this->deprecation = $reason;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeprecationReason(): string
    {
        return (string)$this->deprecation;
    }
}

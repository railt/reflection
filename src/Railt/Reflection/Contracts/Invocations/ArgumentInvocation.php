<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Invocations;

use Railt\Reflection\Contracts\Dependent\ArgumentDefinition;
use Railt\Reflection\Contracts\Dependent\DependentDefinition;

/**
 * Interface ArgumentInvocation
 */
interface ArgumentInvocation extends DependentDefinition, Invocable
{
    /**
     * @return ArgumentDefinition
     */
    public function getDefinition(): ArgumentDefinition;

    /**
     * @return mixed
     */
    public function getPassedValue();
}
<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Invocation\Dependent;

use Railt\Reflection\Contracts\Definition\Dependent\ArgumentDefinition;

/**
 * Interface ArgumentInvocation
 */
interface ArgumentInvocation extends DependentTypeInvocation
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return ArgumentDefinition
     */
    public function getArgumentDefinition(): ArgumentDefinition;
}

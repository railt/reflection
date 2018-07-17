<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesSchema;
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeDefinitions;

/**
 * Interface Reflection
 */
interface Reflection extends ProvidesTypeDefinitions, ProvidesSchema
{
    /**
     * @return iterable|Document[]
     */
    public function getDocuments(): iterable;
}

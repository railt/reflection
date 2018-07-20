<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeDefinitions;
use Railt\Reflection\Contracts\Invocation\Behaviour\ProvidesDirectives;

/**
 * The Document is an object that contains information
 * about all types available in one same context.
 *
 * This can be, for example, a GraphQL schema file.
 */
interface Document extends ProvidesTypeDefinitions, ProvidesDirectives, Definition
{
    /**
     * @return Dictionary
     */
    public function getDictionary(): Dictionary;

    /**
     * @return string
     */
    public function getName(): string;
}

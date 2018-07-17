<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition;

/**
 * Interface SchemaDefinition
 */
interface SchemaDefinition extends TypeDefinition
{
    /**
     * @var string
     */
    public const DEFAULT_SCHEMA_NAME = 'Schema';

    /**
     * @return ObjectDefinition
     */
    public function getQuery(): ObjectDefinition;

    /**
     * @return ObjectDefinition|null
     */
    public function getMutation(): ?ObjectDefinition;

    /**
     * @return bool
     */
    public function hasMutation(): bool;

    /**
     * @return ObjectDefinition|null
     */
    public function getSubscription(): ?ObjectDefinition;

    /**
     * @return bool
     */
    public function hasSubscription(): bool;
}

<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Railgun\Contracts;

/**
 * Interface TypeDefinitionInterface
 * @package Serafim\Railgun\Contracts
 */
interface TypeDefinitionInterface
{
    /**
     * @return string
     */
    public function getTypeName(): string;

    /**
     * @return bool
     */
    public function isNullable(): bool;

    /**
     * @return bool
     */
    public function isList(): bool;
}
<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts;

use Railt\Io\PositionInterface;
use Railt\Io\Readable;
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesType;

/**
 * Interface Definition
 */
interface Definition extends PositionInterface, ProvidesType
{
    /**
     * @return Readable
     */
    public function getFile(): Readable;

    /**
     * @return Document
     */
    public function getDocument(): Document;
    
    /**
     * @return Dictionary
     */
    public function getDictionary(): Dictionary;

    /**
     * @return string
     */
    public function __toString(): string;
}

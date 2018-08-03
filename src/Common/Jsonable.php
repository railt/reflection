<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Common;

use Railt\Io\Readable;
use Railt\Reflection\Contracts\Document;

/**
 * Trait Jsonable
 */
trait Jsonable
{
    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $result = [];

        foreach ($this->getObjectFields() as $field => $value) {
            if ($value instanceof Readable || $value instanceof Document) {
                continue;
            }

            if ($field === 'parent' || $field === 'dictionary') {
                continue;
            }

            $result[$field] = $value;
        }

        return $result;
    }
}

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
use Railt\Reflection\Contracts\Definition;
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
            foreach ($this->jsonNonRenderableTypes() as $type) {
                if ($value instanceof $type) {
                    continue 2;
                }
            }

            foreach ($this->jsonNonRenderableFields() as $name) {
                if ($field === $name) {
                    continue 2;
                }
            }

            $result[$field] = $value;
        }

        // Additional information about type
        if ($this instanceof Definition) {
            $result['__typename'] = $this::getType()->getName();
        }

        return $result;
    }

    /**
     * @return iterable|string[]
     */
    private function jsonNonRenderableTypes(): iterable
    {
        yield Readable::class;
        yield Document::class;
    }

    /**
     * @return iterable|string[]
     */
    private function jsonNonRenderableFields(): iterable
    {
        // Recursive relation exclusion
        yield 'parent';

        // Dictionary relation exclusion
        yield 'dictionary';

        // File information exclusion
        yield 'offset';
        //yield 'line';
        yield 'column';

        // Reverse superfluous inheritance information
        yield 'extendedBy';
    }
}

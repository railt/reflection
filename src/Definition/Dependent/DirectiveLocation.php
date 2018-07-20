<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Dependent;

use Railt\Reflection\Contracts\Definition\Dependent\DirectiveLocation as DirectiveLocationInterface;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Document;
use Railt\Reflection\Type;

/**
 * Class DirectiveLocation
 */
class DirectiveLocation extends AbstractDependentTypeDefinition implements DirectiveLocationInterface
{
    /**
     * DirectiveLocation constructor.
     * @param TypeDefinition $parent
     * @param Document $document
     * @param string $name
     */
    public function __construct(TypeDefinition $parent, Document $document, string $name)
    {
        \assert(\in_array($name, \array_merge(static::EXECUTABLE_LOCATIONS, static::SDL_LOCATIONS), true));

        parent::__construct($parent, $document, $name);
    }

    /**
     * @return bool
     */
    public function isExecutable(): bool
    {
        return \in_array($this->getName(), static::EXECUTABLE_LOCATIONS, true);
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return \in_array($this->getName(), static::SDL_LOCATIONS, true);
    }

    /**
     * @param TypeInterface $type
     * @return bool
     */
    public function isAllowedFor(TypeInterface $type): bool
    {
        $location = static::LOCATION_TO_TYPES[$this->getName()] ?? Type::ANY;

        return $type->instanceOf(Type::of($location));
    }

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::DIRECTIVE_LOCATION);
    }
}

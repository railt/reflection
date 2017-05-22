<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Railgun\Types\Creators;

use Serafim\Railgun\Contracts\Partials\ArgumentTypeInterface;
use Serafim\Railgun\Support\InteractWithName;
use Serafim\Railgun\Contracts\TypeDefinitionInterface;
use Serafim\Railgun\Contracts\Partials\FieldTypeInterface;
use Serafim\Railgun\Types\Schemas\Arguments;
use Serafim\Railgun\Types\Schemas\TypeDefinition;

/**
 * Class FieldRegistrar
 * @package Serafim\Railgun\Types\Creators
 */
class FieldCreator extends TypeCreator implements FieldTypeInterface
{
    use InteractWithName;

    /**
     * @var \Closure|null
     */
    private $resolver;

    /**
     * @var string|null
     */
    private $deprecationReason;

    /**
     * @var array|ArgumentTypeInterface[]
     */
    private $arguments = [];

    /**
     * FieldCreator constructor.
     * @param string $type
     * @param null|string $name
     */
    public function __construct(string $type, ?string $name = null)
    {
        $this->name = $name;

        parent::__construct($type, null);
    }

    /**
     * @return string
     */
    protected function getDescriptionSuffix(): string
    {
        return 'type field';
    }

    /**
     * @param TypeDefinition $definition
     * @return TypeDefinitionInterface
     */
    public function getType(TypeDefinition $definition): TypeDefinitionInterface
    {
        return $this;
    }

    /**
     * @param Arguments $schema
     * @return iterable|ArgumentTypeInterface[]
     */
    public function getArguments(Arguments $schema): iterable
    {
        return $this->arguments;
    }

    /**
     * @return bool
     */
    public function isResolvable(): bool
    {
        return $this->resolver !== null;
    }

    /**
     * @return bool
     */
    public function isDeprecated(): bool
    {
        return $this->deprecationReason !== null;
    }

    /**
     * @return string
     */
    public function getDeprecationReason(): string
    {
        return (string)$this->deprecationReason;
    }

    /**
     * @param string $reason
     * @return FieldCreator|$this
     */
    public function deprecate(?string $reason = null): FieldCreator
    {
        $this->deprecationReason = $reason ?? ($this->getName() . ' is deprecated');

        return $this;
    }

    /**
     * @param $value
     * @param array $arguments
     * @return mixed
     */
    public function resolve($value, array $arguments = [])
    {
        $result = ($this->resolver)($value, $arguments);

        if ($result instanceof \Traversable) {
            return iterator_to_array($result);
        }

        return $result;
    }

    /**
     * @param \Closure $then
     * @return FieldCreator|$this
     */
    public function then(\Closure $then): FieldCreator
    {
        $this->resolver = $then;

        return $this;
    }
}
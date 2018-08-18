<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition;

use Railt\Reflection\AbstractTypeDefinition;
use Railt\Reflection\Contracts\Definition\ObjectDefinition;
use Railt\Reflection\Contracts\Definition\SchemaDefinition as SchemaDefinitionInterface;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Document;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Type;

/**
 * Class SchemaDefinition
 */
class SchemaDefinition extends AbstractTypeDefinition implements SchemaDefinitionInterface
{
    /**
     * @var string
     */
    protected $query;

    /**
     * @var string|null
     */
    protected $mutation;

    /**
     * @var string|null
     */
    protected $subscription;

    /**
     * SchemaDefinition constructor.
     * @param Document|\Railt\Reflection\Contracts\Document $document
     * @param string|null $name
     */
    public function __construct(Document $document, string $name = null)
    {
        parent::__construct($document, $name ?? self::DEFAULT_SCHEMA_NAME);
    }

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::SCHEMA);
    }

    /**
     * @param TypeDefinition|string $query
     * @return SchemaDefinition
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function withQuery($query): SchemaDefinition
    {
        $this->query = $this->nameOf($query);

        return $this;
    }

    /**
     * @return ObjectDefinition|TypeDefinition
     */
    public function getQuery(): ObjectDefinition
    {
        return $this->fetch($this->query);
    }

    /**
     * @param TypeDefinition|null $mutation
     * @return SchemaDefinition
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function withMutation($mutation = null): SchemaDefinition
    {
        $this->mutation = $mutation ? $this->nameOf($mutation) : null;

        return $this;
    }

    /**
     * @return null|ObjectDefinition|TypeDefinition
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function getMutation(): ?ObjectDefinition
    {
        return $this->fetchOrNull($this->mutation);
    }

    /**
     * @return bool
     */
    public function hasMutation(): bool
    {
        return $this->mutation !== null;
    }

    /**
     * @param ObjectDefinition|null $subscription
     * @return SchemaDefinition
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function withSubscription($subscription = null): SchemaDefinition
    {
        $this->subscription = $subscription ? $this->nameOf($subscription) : null;

        return $this;
    }

    /**
     * @return null|ObjectDefinition|TypeDefinition
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function getSubscription(): ?ObjectDefinition
    {
        return $this->fetchOrNull($this->subscription);
    }

    /**
     * @return bool
     */
    public function hasSubscription(): bool
    {
        return $this->subscription !== null;
    }

    /**
     * @return bool
     */
    public function isRenderable(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isInputable(): bool
    {
        return false;
    }
}

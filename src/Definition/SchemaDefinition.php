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
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Document;
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
     * @param Document $document
     * @param string $queryType
     * @param string|null $name
     */
    public function __construct(Document $document, string $queryType, string $name = null)
    {
        $this->query = $queryType;

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
     * @param ObjectDefinition $query
     * @return SchemaDefinition
     */
    public function withQuery(ObjectDefinition $query): SchemaDefinition
    {
        $this->query = $query->getName();

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
     * @param ObjectDefinition|null $mutation
     * @return SchemaDefinition
     */
    public function withMutation(?ObjectDefinition $mutation): SchemaDefinition
    {
        $this->mutation = $mutation ? $mutation->getName() : null;

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
     */
    public function withSubscription(?ObjectDefinition $subscription): SchemaDefinition
    {
        $this->subscription = $subscription ? $subscription->getName() : null;

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
}

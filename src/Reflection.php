<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection;

use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Dictionary;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Reflection as ReflectionInterface;
use Railt\Reflection\Dictionary\ProxyDictionary;
use Railt\Reflection\Dictionary\SimpleDictionary;
use Railt\Reflection\Exception\ReflectionException;
use Railt\Reflection\Introspection\IntrospectionDocument;
use Railt\Reflection\Stdlib\StdlibDocument;

/**
 * Class Reflection
 */
class Reflection extends ProxyDictionary implements ReflectionInterface
{
    /**
     * @var int
     */
    public const LOAD_STDLIB = 0x02;

    /**
     * @var int
     */
    public const LOAD_INTROSPECTION = 0x04;

    /**
     * @var array|DocumentInterface[]
     */
    protected $documents = [];

    /**
     * Reflection constructor.
     * @param Dictionary|null $parent
     * @param int $options
     * @throws Exception\TypeConflictException
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function __construct(Dictionary $parent = null, int $options = self::LOAD_INTROSPECTION | self::LOAD_STDLIB)
    {
        parent::__construct($parent ?? new SimpleDictionary());

        $this->boot($options);
    }

    /**
     * @param int $options
     * @return void
     * @throws Exception\TypeConflictException
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    private function boot(int $options): void
    {
        if ($options & self::LOAD_STDLIB) {
            $this->addDocument(new StdlibDocument($this));
        }

        if ($options & self::LOAD_INTROSPECTION) {
            $this->addDocument(new IntrospectionDocument($this));
        }
    }

    /**
     * @param DocumentInterface $document
     */
    public function addDocument(DocumentInterface $document): void
    {
        $this->documents[$document->getName()] = $document;
    }

    /**
     * @return iterable
     */
    public function getDocuments(): iterable
    {
        return \array_values($this->documents);
    }

    /**
     * @param TypeDefinition $type
     * @return Dictionary
     */
    public function add(TypeDefinition $type): Dictionary
    {
        $this->addDocument($type->getDocument());

        return parent::add($type);
    }
}

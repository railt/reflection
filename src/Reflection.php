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
use Railt\Reflection\Stack\ProvidesCallStack;
use Railt\Reflection\Stdlib\GraphQLDocument;

/**
 * Class Reflection
 */
class Reflection extends ProxyDictionary implements ReflectionInterface
{
    /**
     * @var array|DocumentInterface[]
     */
    protected $documents = [];

    /**
     * Reflection constructor.
     * @param Dictionary|null $parent
     * @throws ReflectionException
     */
    public function __construct(Dictionary $parent = null)
    {
        parent::__construct($parent ?? new SimpleDictionary());

        $this->wrap(function () {
            $this->boot();
        });
    }

    /**
     * @param \Closure $then
     * @return mixed
     * @throws ReflectionException
     */
    private function wrap(\Closure $then)
    {
        try {
            return $then();
        } catch (ReflectionException $e) {
            $parent = $this->getParentDictionary();

            if ($parent instanceof ProvidesCallStack) {
                $e = $e->withCallStack($parent->getCallStack());
            }

            throw $e;
        }
    }

    /**
     * @return void
     * @throws Exception\TypeConflictException
     */
    private function boot(): void
    {
        $this->addDocument(new GraphQLDocument($this));
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

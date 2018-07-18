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
     */
    public function __construct(Dictionary $parent = null)
    {
        parent::__construct($parent ?? new SimpleDictionary());
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

    /**
     * @param DocumentInterface $document
     */
    public function addDocument(DocumentInterface $document): void
    {
        $this->documents[$document->getName()] = $document;
    }
}

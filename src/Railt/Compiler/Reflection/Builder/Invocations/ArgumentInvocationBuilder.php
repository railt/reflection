<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Reflection\Builder\Invocations;

use Hoa\Compiler\Llk\TreeNode;
use Railt\Compiler\Reflection\Base\Invocations\BaseArgumentInvocation;
use Railt\Compiler\Reflection\Builder\DocumentBuilder;
use Railt\Compiler\Reflection\Builder\Process\Compilable;
use Railt\Compiler\Reflection\Builder\Process\Compiler;
use Railt\Compiler\Reflection\Builder\Process\ValueBuilder;
use Railt\Compiler\Reflection\Contracts\Definitions\TypeDefinition;
use Railt\Compiler\Reflection\Contracts\Dependent\Argument\HasArguments;
use Railt\Compiler\Reflection\Contracts\Invocations\DirectiveInvocation;

/**
 * Class ArgumentInvocationBuilder
 */
class ArgumentInvocationBuilder extends BaseArgumentInvocation implements Compilable
{
    use Compiler;

    /**
     * ArgumentBuilder constructor.
     * @param TreeNode $ast
     * @param DocumentBuilder $document
     * @param DirectiveInvocation $parent
     * @throws \Railt\Compiler\Exceptions\TypeConflictException
     */
    public function __construct(TreeNode $ast, DocumentBuilder $document, DirectiveInvocation $parent)
    {
        $this->parent = $parent;
        $this->boot($ast, $document);
    }

    /**
     * @param TreeNode $ast
     * @return bool
     */
    protected function onCompile(TreeNode $ast): bool
    {
        if ($ast->getId() === '#Value') {
            $this->value = ValueBuilder::parse($ast->getChild(0));
        }

        return false;
    }

    /**
     * @return null|TypeDefinition
     */
    public function getTypeDefinition(): ?TypeDefinition
    {
        /** @var HasArguments $parent */
        $parent = $this->parent->getTypeDefinition();

        return $parent instanceof HasArguments
            ? $parent->getArgument($this->getName())
            : null;
    }
}
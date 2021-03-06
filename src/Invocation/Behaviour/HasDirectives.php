<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\Deprecatable;
use Railt\Reflection\Contracts\Invocation\Behaviour\ProvidesDirectives;
use Railt\Reflection\Contracts\Invocation\DirectiveInvocation;
use Railt\Reflection\Definition\Behaviour\HasDeprecation;

/**
 * Trait HasDirectives
 */
trait HasDirectives
{
    /**
     * @var array|DirectiveInvocation[]
     */
    protected $directives = [];

    /**
     * @param string $name
     * @return bool
     */
    public function hasDirective(string $name): bool
    {
        return \iterator_count($this->getDirectives($name)) > 0;
    }

    /**
     * @param string|null $name
     * @return iterable|DirectiveInvocation[]|\Generator
     */
    public function getDirectives(string $name = null): iterable
    {
        foreach ($this->directives as $directive) {
            if ($name === null || $name === $directive->getDefinition()->getName()) {
                yield $directive;
            }
        }
    }

    /**
     * @param DirectiveInvocation ...$invocations
     * @return ProvidesDirectives|$this
     */
    public function withDirective(DirectiveInvocation ...$invocations): ProvidesDirectives
    {
        foreach ($invocations as $invocation) {
            $this->directives[] = $invocation;

            if ($this->isDeprecatedDirective($invocation)) {
                $this->withDeprecationReason($this->getDirectiveDeprecationReason($invocation));
            }
        }

        return $this;
    }

    /**
     * @param DirectiveInvocation $directive
     * @return bool
     */
    private function isDeprecatedDirective(DirectiveInvocation $directive): bool
    {
        return $this instanceof Deprecatable && $directive->getName() === 'deprecated';
    }

    /**
     * @param DirectiveInvocation $deprecated
     * @return null|string
     */
    private function getDirectiveDeprecationReason(DirectiveInvocation $deprecated): ?string
    {
        $argument = $deprecated->getArgument('reason');

        /** @var HasDeprecation $this */
        if ($argument) {
            return $argument->getValue();
        }

        $definition = $deprecated->getDefinition();
        $argument   = $definition->getArgument('reason');

        return $argument->getDefaultValue();
    }
}

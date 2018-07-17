<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation\Behaviour;

use Railt\Reflection\Contracts\Invocation\Behaviour\ProvidesDirectives;
use Railt\Reflection\Contracts\Invocation\DirectiveInvocation;

/**
 * Trait HasDirectives
 * @mixin ProvidesDirectives
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
            if ($name === null || $name === $directive->getTypeDefinition()->getName()) {
                yield $directive;
            }
        }
    }

    /**
     * @return int
     */
    public function getNumberOfDirectives(): int
    {
        return \count($this->directives);
    }

    /**
     * @param DirectiveInvocation $invocation
     */
    protected function addDirective(DirectiveInvocation $invocation): void
    {
        $this->directives[] = $invocation;
    }
}

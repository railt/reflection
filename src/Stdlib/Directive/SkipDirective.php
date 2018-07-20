<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Stdlib\Directive;

use Railt\Reflection\Definition\Dependent\ArgumentDefinition;
use Railt\Reflection\Definition\Dependent\DirectiveLocation;
use Railt\Reflection\Definition\DirectiveDefinition;
use Railt\Reflection\Document;

/**
 * Class SkipDirective
 */
class SkipDirective extends DirectiveDefinition
{
    /**
     * @var string[]
     */
    private const LOCATIONS = [
        DirectiveLocation::FIELD,
        DirectiveLocation::FRAGMENT_SPREAD,
        DirectiveLocation::INLINE_FRAGMENT,
    ];

    /**
     * @var string
     */
    public const TYPE_NAME = 'skip';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = <<<Description
The @skip directive may be provided for fields, fragment spreads, and inline fragments,
and allows for conditional exclusion during execution as described by the if argument.
Description;

    /**
     * BooleanScalar constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        parent::__construct($document, self::TYPE_NAME);

        $this->withDescription(self::TYPE_DESCRIPTION)
            ->withArgument((new ArgumentDefinition($this, $document, 'if', 'Boolean'))
                ->withModifiers(ArgumentDefinition::IS_NOT_NULL))
            ->withLocation(...\array_map(function (string $location) use ($document): DirectiveLocation {
                return new DirectiveLocation($this, $document, $location);
            }, self::LOCATIONS));
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return 48;
    }
}

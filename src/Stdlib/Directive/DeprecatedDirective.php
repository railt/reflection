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
 * Class DeprecatedDirective
 */
class DeprecatedDirective extends DirectiveDefinition
{
    /**
     * @var string[]
     */
    private const LOCATIONS = [
        DirectiveLocation::OBJECT,
        DirectiveLocation::INTERFACE,
        DirectiveLocation::FIELD_DEFINITION,
        DirectiveLocation::SCALAR,
        DirectiveLocation::UNION,
        DirectiveLocation::ENUM,
        DirectiveLocation::ENUM_VALUE,
        DirectiveLocation::INPUT_OBJECT,
        DirectiveLocation::INPUT_UNION,
        DirectiveLocation::INPUT_FIELD_DEFINITION,
    ];

    /**
     * @var string
     */
    public const TYPE_NAME = 'deprecated';

    /**
     * @var string
     */
    public const TYPE_DESCRIPTION = <<<Description
The @deprecated directive is used within the type system definition language to
indicate deprecated portions of a GraphQL service’s schema, such as deprecated
fields on a type or deprecated enum values.
Description;

    /**
     * BooleanScalar constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        parent::__construct($document, self::TYPE_NAME);

        $this->withDescription(self::TYPE_DESCRIPTION)
            ->withArgument((new ArgumentDefinition($this, $document, 'reason','String'))
                ->withDefaultValue('No longer supported'))
            ->withLocation(...\array_map(function (string $location) use ($document): DirectiveLocation {
                return new DirectiveLocation($this, $document, $location);
            }, self::LOCATIONS));
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return 39;
    }
}

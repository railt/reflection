<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Introspection;

use Railt\Io\Exception\NotReadableException;
use Railt\Io\File;
use Railt\Io\Readable;
use Railt\Reflection\Document;
use Railt\Reflection\Introspection\Enum\DirectiveLocationEnum;
use Railt\Reflection\Introspection\Enum\TypeKindEnum;
use Railt\Reflection\Introspection\Object\DirectiveObject;
use Railt\Reflection\Introspection\Object\EnumValueObject;
use Railt\Reflection\Introspection\Object\FieldObject;
use Railt\Reflection\Introspection\Object\InputValueObject;
use Railt\Reflection\Introspection\Object\SchemaObject;
use Railt\Reflection\Introspection\Object\TypeObject;
use Railt\Reflection\Reflection;

/**
 * Class IntrospectionDocument
 */
class IntrospectionDocument extends Document
{
    /**
     * @var string
     */
    public const INTROSPECTION_SCHEMA_PATH = __DIR__ . '/../../resources/introspection.graphqls';

    /**
     * IntrospectionDocument constructor.
     * @param Reflection $parent
     */
    public function __construct(Reflection $parent)
    {
        parent::__construct($parent, $this->getSchemaFile());

        $this->boot();
    }

    /**
     * @return Readable
     */
    private function getSchemaFile(): Readable
    {
        try {
            return File::fromPathname(static::INTROSPECTION_SCHEMA_PATH);
        } catch (NotReadableException $e) {
            return File::fromSources('');
        }
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        $this->withDefinition(new SchemaObject($this));
        $this->withDefinition(new TypeObject($this));
        $this->withDefinition(new FieldObject($this));
        $this->withDefinition(new InputValueObject($this));
        $this->withDefinition(new DirectiveObject($this));
        $this->withDefinition(new EnumValueObject($this));
        $this->withDefinition(new TypeKindEnum($this));
        $this->withDefinition(new DirectiveLocationEnum($this));
    }
}

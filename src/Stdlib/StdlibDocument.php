<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Stdlib;

use Railt\Io\Exception\NotReadableException;
use Railt\Io\File;
use Railt\Io\Readable;
use Railt\Reflection\Contracts\Reflection;
use Railt\Reflection\Document;
use Railt\Reflection\Stdlib\Directive\DeprecatedDirective;
use Railt\Reflection\Stdlib\Directive\IncludeDirective;
use Railt\Reflection\Stdlib\Directive\SkipDirective;
use Railt\Reflection\Stdlib\Scalar\BooleanScalar;
use Railt\Reflection\Stdlib\Scalar\DateTimeScalar;
use Railt\Reflection\Stdlib\Scalar\FloatScalar;
use Railt\Reflection\Stdlib\Scalar\IdScalar;
use Railt\Reflection\Stdlib\Scalar\IntScalar;
use Railt\Reflection\Stdlib\Scalar\StringScalar;

/**
 * Class GraphQLDocument
 */
class StdlibDocument extends Document
{
    /**
     * @var string
     */
    public const STDLIB_SCHEMA_PATH = __DIR__ . '/../../resources/stdlib.graphqls';

    /**
     * GraphQLDocument constructor.
     * @param Reflection $parent
     * @throws \Railt\Reflection\Exception\TypeConflictException
     * @throws \Railt\Io\Exception\ExternalFileException
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
            return File::fromPathname(static::STDLIB_SCHEMA_PATH);
        } catch (NotReadableException $e) {
            return File::fromSources('');
        }
    }

    /**
     * @return void
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    private function boot(): void
    {
        /**
         * - ID
         * -- String
         * --- DateTime
         * --- Float
         * ---- Int
         * - Boolean
         */
        $this->withDefinition($id = new IdScalar($this));
        $this->withDefinition($bool = new BooleanScalar($this));
        $this->withDefinition($string = (new StringScalar($this))->extends($id));
        $this->withDefinition($date = (new DateTimeScalar($this))->extends($string));
        $this->withDefinition($float = (new FloatScalar($this))->extends($string));
        $this->withDefinition($int = (new IntScalar($this))->extends($float));

        $this->withDefinition($any = new AnyType($this));

        $this->withDefinition($deprecated = new DeprecatedDirective($this));
        $this->withDefinition($include = new IncludeDirective($this));
        $this->withDefinition($skip = new SkipDirective($this));
    }
}

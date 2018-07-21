<?php
/**
 * This file is part of reflection package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Railt\Io\File;
use Railt\Reflection\Definition\Dependent\ArgumentDefinition;
use Railt\Reflection\Definition\Dependent\FieldDefinition;
use Railt\Reflection\Definition\ObjectDefinition;
use Railt\Reflection\Document;
use Railt\Reflection\Reflection;


require __DIR__ . '/vendor/autoload.php';

$sdl = new Reflection();
$doc = new Document($sdl, File::fromPathname(__DIR__ . '/1.graphqls'));
$obj = (new ObjectDefinition($doc, 'obj'))->withLine(2);
$fld = (new FieldDefinition($obj, 'fld', 'A'))->withLine(3);
$arg = (new ArgumentDefinition($fld, 'arg', 'Boolean'))->withLine(4);


$obj->withField($fld->withArgument($arg));

<?php

namespace  Differ\Formatters\Stylish;

use function Differ\Tree\getType;
use function Differ\Tree\getName;
use function Differ\Tree\getOldValue;
use function Differ\Tree\getNewValue;
use function Differ\Tree\getChildren;
use function Differ\Formatters\Preparation\boolToString;

function iter($tree, $space)
{
    $res = '';
    $addedSpace = '    ';
    foreach ($tree as $node) {
        $type = getType($node);
        $name = getName($node);
        $oldValue = getOldValue($node);
        $newValue = getNewValue($node);
        $children = getChildren($node);

        $mapping = [
            'added' => PHP_EOL . $space . "  + {$name}: " . prepareValue($newValue, $space . $addedSpace),
            'removed' => PHP_EOL . $space . "  - {$name}: " . prepareValue($oldValue, $space . $addedSpace),
            'notChanged' => PHP_EOL . $space . "    {$name}: " . prepareValue($newValue, $space . $addedSpace),
            'updated' => PHP_EOL . $space . "  - {$name}: " . prepareValue($oldValue, $space . $addedSpace) .
                PHP_EOL . $space . "  + {$name}: " . prepareValue($newValue, $space . $addedSpace),
            'nested' => PHP_EOL . $space . "    {$name}: {" . iter($children, $space . $addedSpace) .
                PHP_EOL . $space . '    }',
        ];
        $res = $res . $mapping[$type];
    }
    return $res;
}

function stylish($tree)
{
    $res = iter($tree, '');
    return '{' . $res . PHP_EOL . '}' . PHP_EOL;
}

function prepareValue($value, $space = '')
{
    if (!is_object($value)) {
        return boolToString($value);
    }
    $arr = (array) ($value);
    $res = '';
    foreach ($arr as $key => $value) {
        $res = $res . PHP_EOL . $space . "    {$key}: " . prepareValue($value, $space . '    ');
    }
    return '{' . $res . PHP_EOL . $space . '}';
}

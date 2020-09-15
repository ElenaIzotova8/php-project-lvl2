<?php

namespace  Differ\Formatters\Stylish;

use function Differ\Tree\getType;
use function Differ\Tree\getName;
use function Differ\Tree\getOldValue;
use function Differ\Tree\getNewValue;
use function Differ\Tree\getChildren;
use function Differ\Tree\isNested;

function stylish($tree)
{
    $mapping = [
        'added' =>
            fn($node) => PHP_EOL . "  + {$node['name']}: {$node['newValue']}",
        'removed' =>
            fn($node) => PHP_EOL . "  - {$node['name']}: {$node['oldValue']}",
        'updated' =>
            fn($node) => PHP_EOL . "  - {$node['name']}: {$node['oldValue']}" .
            PHP_EOL . "  + {$node['name']}: {$node['newValue']}",
        'notChanged' =>
            fn($node) => PHP_EOL . "    {$node['name']}: {$node['newValue']}",
    ];

    $res = '';
    foreach ($tree as $node) {
        $res = $res . $mapping[getType($node)]($node);
    }
    return '{' . $res . PHP_EOL . '}' . PHP_EOL;
}

function boolToString($bool)
{
    if (is_bool($bool)) {
        if ($bool === true) {
            return 'true';
        }
        return 'false';
    }
    return $bool;
}

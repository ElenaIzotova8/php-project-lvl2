<?php

namespace  Differ\Formatters\Stylish;

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
        $res = $res . $mapping[$node['type']]($node);
    }
    return '{' . $res . PHP_EOL . '}' . PHP_EOL;
}

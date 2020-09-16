<?php

namespace  Differ\Formatters\Plain;

use function Differ\Tree\getType;
use function Differ\Tree\getName;
use function Differ\Tree\getOldValue;
use function Differ\Tree\getNewValue;
use function Differ\Tree\getChildren;

function iter($tree, $preName)
{
    $res = '';
    foreach ($tree as $node) {
        $type = getType($node);
        $name = $preName . getName($node);
        $oldValue = prepareValue(getOldValue($node));
        $newValue = prepareValue(getNewValue($node));
        $children = getChildren($node);

        $mapping = [
            'added' => "Property '{$name}' was {$type} with value: {$newValue}" . PHP_EOL,
            'removed' => "Property '{$name}' was {$type}" . PHP_EOL,
            'notChanged' => '',
            'updated' => "Property '{$name}' was {$type}. From {$oldValue} to {$newValue}" . PHP_EOL,
            'nested' => iter($children, $name . '.'),
        ];
        $res = $res . $mapping[$type];
    }
    return $res;
}

function plain($tree)
{
    return iter($tree, '');
}

function prepareValue($value)
{
    $preparedValue = is_string($value) ? "'{$value}'" : $value;
    $preparedValue = is_object($preparedValue) ? '[complex value]' : $preparedValue;
    if (is_bool($preparedValue)) {
        if ($preparedValue === true) {
            return 'true';
        }
        return 'false';
    }
    return $preparedValue;
}

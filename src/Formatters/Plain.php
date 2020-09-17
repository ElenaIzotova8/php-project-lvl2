<?php

namespace  Differ\Formatters\Plain;

use function Differ\Tree\getType;
use function Differ\Tree\getName;
use function Differ\Tree\getOldValue;
use function Differ\Tree\getNewValue;
use function Differ\Tree\getChildren;
use function Differ\Formatters\Preparation\boolToString;

function iter($tree, $preName)
{
    return array_reduce($tree, function ($res, $node) use ($preName) {
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
        return $res . $mapping[$type];
    }, '');
}

function plain($tree)
{
    return iter($tree, '');
}

function prepareValue($value)
{
    $preparedValue = is_string($value) ? "'{$value}'" : boolToString($value);
    $preparedValue = is_object($preparedValue) ? '[complex value]' : $preparedValue;
    return $preparedValue;
}

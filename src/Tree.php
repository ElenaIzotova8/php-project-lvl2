<?php

namespace  Differ\Tree;

function makeNode(string $name, string $type, $oldValue, $newValue)
{
    return [
        "name" => $name,
        "type" => $type,
        "oldValue" => $oldValue,
        "newValue" => $newValue
    ];
}

function getName($node)
{
    return $node['name'];
}

function getType($node)
{
    return $node['type'];
}

function getOldValue($node)
{
    return $node['oldValue'];
}

function getNewValue($node)
{
    return $node['newValue'];
}

function diffAsTree($arr1, $arr2)
{
    $arr = array_merge($arr1, $arr2);
    ksort($arr);
    $tree = [];
    foreach ($arr as $key => $value) {
        if (!array_key_exists($key, $arr1)) {
            $tree[] = makeNode($key, 'added', null, boolToString($value));
        } else {
            if (!array_key_exists($key, $arr2)) {
                $tree[] = makeNode($key, 'deleted', boolToString($value), null);
            } else {
                if ($arr1[$key] === $arr2[$key]) {
                    $tree[] = makeNode($key, 'notChanged', boolToString($value), boolToString($value));
                } else {
                    $tree[] = makeNode($key, 'changed', boolToString($arr1[$key]), boolToString($arr2[$key]));
                }
            }
        }
    }
    return $tree;
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

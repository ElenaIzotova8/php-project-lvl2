<?php

namespace  Differ\Tree;

function makeNode(string $name, string $type, $oldValue, $newValue, $children = [])
{
    return [
        "name" => $name,
        "type" => $type,
        "oldValue" => $oldValue,
        "newValue" => $newValue,
        "children" => $children
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

function getChildren($node)
{
    return $node['children'];
}

function diffAsTree($data1, $data2)
{
    $data1 = is_object($data1) ? (array) $data1 : $data1;
    $data2 = is_object($data2) ? (array) $data2 : $data2;
    $keys = array_keys(array_merge($data1, $data2));
    sort($keys);
    return array_map(function ($key) use ($data1, $data2) {
        if (!array_key_exists($key, $data1)) {
            return makeNode($key, 'added', null, $data2[$key]);
        };
        if (!array_key_exists($key, $data2)) {
            return makeNode($key, 'removed', $data1[$key], null);
        };
        if (is_object($data1[$key]) && (is_object($data2[$key]))) {
            return makeNode($key, 'nested', $data1[$key], $data2[$key], diffAsTree($data1[$key], $data2[$key]));
        };
        if ($data1[$key] !== $data2[$key]) {
            return makeNode($key, 'updated', $data1[$key], $data2[$key]);
        };
        return makeNode($key, 'notChanged', $data1[$key], $data2[$key]);
    }, $keys);
}

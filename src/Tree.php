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
    $arr = array_merge($data1, $data2);
    ksort($arr);
    $tree = [];
    foreach ($arr as $key => $value) {
        if (!array_key_exists($key, $data1)) {
            $tree[] = makeNode($key, 'added', null, $value);
        } else {
            if (!array_key_exists($key, $data2)) {
                $tree[] = makeNode($key, 'removed', $value, null);
            } else {
                if (is_object($data1[$key]) && (is_object($data2[$key]))) {
                    $tree[] =
                    makeNode($key, 'nested', $data1[$key], $data2[$key], diffAsTree($data1[$key], $data2[$key]));
                } else {
                    if ($data1[$key] !== $data2[$key]) {
                        $tree[] = makeNode($key, 'updated', $data1[$key], $data2[$key]);
                    } else {
                        $tree[] = makeNode($key, 'notChanged', $value, $value);
                    }
                }
            }
        }
    }
    return $tree;
}

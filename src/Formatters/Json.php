<?php

namespace  Differ\Formatters\Json;

use function Differ\Tree\getType;
use function Differ\Tree\getName;
use function Differ\Tree\getOldValue;
use function Differ\Tree\getNewValue;
use function Differ\Tree\getChildren;

function json($tree)
{
    return json_encode(diffAsArray($tree), JSON_PRETTY_PRINT);
}

function diffAsArray($tree)
{
    return array_reduce($tree, function ($res, $node) {
        $type = getType($node);
        $name = getName($node);
        $oldValue = getOldValue($node);
        $newValue = getNewValue($node);
        $children = getChildren($node);
        switch ($type) {
            case 'added':
                $res["+ {$name}"] = $newValue;
                break;
            case 'removed':
                $res["- {$name}"] = $oldValue;
                break;
            case 'notChanged':
                $res["  {$name}"] = $oldValue;
                break;
            case 'updated':
                $res["- {$name}"] = $oldValue;
                $res["+ {$name}"] = $newValue;
                break;
            case 'nested':
                $res["  {$name}"] = diffAsArray($children);
        }
        return $res;
    }, []);
}

<?php

namespace  Differ\Differ;

use function Differ\Parsers\parse;
use function Differ\Tree\diffAsTree;
use function Differ\Formatters\Stylish\stylish;
use function Differ\Formatters\Plain\plain;
use function Differ\Formatters\Json\json;

function genDiff($pathToFile1, $pathToFile2, $format = 'stylish')
{
    $data1 = parse($pathToFile1);
    $data2 = parse($pathToFile2);
    if (is_object($data1)) {
        $arr1 = (array) $data1;
    }
    if (is_object($data2)) {
        $arr2 = (array) $data2;
    }

    $mapping = [
        'stylish' =>
            fn($tree) => stylish($tree),
        'plain' =>
            fn($tree) => plain($tree),
        'json' =>
            fn($tree) => json($tree),
    ];

    return $mapping[$format](diffAsTree($arr1, $arr2));
}

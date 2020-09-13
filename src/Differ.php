<?php

namespace  Differ\Differ;

use function Differ\Parsers\parse;
use function Differ\Tree\diffAsTree;
use function Differ\Formatters\Stylish\stylish;

function genDiff($pathToFile1, $pathToFile2)
{
    $data1 = parse($pathToFile1);
    $data2 = parse($pathToFile2);
    if (is_object($data1)) {
        $arr1 = (array) $data1;
    }
    if (is_object($data2)) {
        $arr2 = (array) $data2;
    }
    return stylish(diffAsTree($arr1, $arr2));
}

<?php

namespace  Differ\Differ;

function genDiff($pathToFile1, $pathToFile2)
{
    $arr1 = json_decode(file_get_contents($pathToFile1), true);
    $arr2 = json_decode(file_get_contents($pathToFile2), true);
    $arr = array_merge($arr1, $arr2);
    $arrRes = [];
    foreach ($arr as $key => $value) {
        if (!array_key_exists($key, $arr1)) {
            $arrRes["+ {$key}"] = $value;
        } else {
            if (!array_key_exists($key, $arr2)) {
                $arrRes["- {$key}"] = $value;
            } else {
                if ($arr1[$key] === $arr2[$key]) {
                    $arrRes[$key] = $value;
                } else {
                    $arrRes["- {$key}"] = $arr1[$key];
                    $arrRes["+ {$key}"] = $arr2[$key];
                }
            }
        }
    }
    $res = '';
    foreach ($arrRes as $key => $value) {
        $value = boolToString($value);
        $res = $res . PHP_EOL . "    {$key}: {$value}";
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

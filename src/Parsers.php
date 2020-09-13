<?php

namespace  Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($pathToFile)
{
    $mapping = [
        'yml' =>
            fn($rawData) => Yaml::parse($rawData, Yaml::PARSE_OBJECT_FOR_MAP),
        'json' =>
            fn($rawData) => json_decode($rawData),
    ];
    $name = explode('.', basename($pathToFile));
    $type = end($name);
    $data = file_get_contents($pathToFile);
    return $mapping[$type]($data);
}

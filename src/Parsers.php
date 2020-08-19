<?php

namespace  Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($pathToFile)
{
    $mapping = [
        'yml' =>
            fn($rawData) => Yaml::parse($rawData),
        'json' =>
            fn($rawData) => json_decode($rawData, true),
    ];
    $name = explode('.', basename($pathToFile));
    $type = end($name);
    $data = file_get_contents($pathToFile); 
    return $mapping[$type]($data);
}

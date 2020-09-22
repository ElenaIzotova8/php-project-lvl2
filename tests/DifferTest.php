<?php

namespace  Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;
use function Funct\Collection\flatten;

class DifferTest extends TestCase
{
    public function addDataProvider()
    {
        $inputs1 = ['beforeIter.json', 'beforeIter.yml'];
        $inputs2 = ['afterIter.json', 'afterIter.yml'];
        $formats = ['stylish', 'plain', 'json'];
        $results = ['diffIter', 'diffIterPlain', 'diffIter.json'];
        return flatten(
            array_map(function ($input1, $input2) use ($formats, $results) {
                return array_map(function ($format, $result) use ($input1, $input2) {
                    return [$this->genPath($input1), $this->genPath($input2), $format, $this->genPath($result)];
                }, $formats, $results);
            }, $inputs1, $inputs2)
        );
    }

    /**
     * @dataProvider addDataProvider
     */
    
    public function testGenDiff($pathToFile1, $pathToFile2, $format, $pathToExpected)
    {
        $actual = genDiff($pathToFile1, $pathToFile2, $format);
        $expected = file_get_contents($pathToExpected);
        $this->assertEquals($expected, $actual);
    }

    private function genPath($baseName)
    {
        $dir = '__fixtures__';
        return "./{$dir}/{$baseName}";
    }
}

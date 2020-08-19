<?php

namespace  Differ\Differ\Tests;
use PHPUnit\Framework\TestCase;
use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testGenDiff()
    {
        $actual1 = genDiff('./__fixtures__/before1.json', './__fixtures__/after1.json');
        $expected1 = '{' . PHP_EOL . '    host: hexlet.io' . PHP_EOL . '    + verbose: true' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected1, $actual1);

        $actual2 = genDiff('./__fixtures__/before2.json', './__fixtures__/after2.json');
        $expected2 = '{' . PHP_EOL . '    - timeout: 50' . PHP_EOL . '    + timeout: 20' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected2, $actual2);

        $actual3 = genDiff('./__fixtures__/before3.json', './__fixtures__/after3.json');
        $expected3 = '{' . PHP_EOL . '    host: hexlet.io' . PHP_EOL . '    - proxy: 123.234.53.22' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected3, $actual3);

        $actual4 = genDiff('./__fixtures__/before1.yml', './__fixtures__/after1.yml');
        $expected4 = '{' . PHP_EOL . '    host: hexlet.io' . PHP_EOL . '    + verbose: true' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected4, $actual4);

        $actual5 = genDiff('./__fixtures__/before2.yml', './__fixtures__/after2.yml');
        $expected5 = '{' . PHP_EOL . '    - timeout: 50' . PHP_EOL . '    + timeout: 20' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected5, $actual5);

        $actual6 = genDiff('./__fixtures__/before3.yml', './__fixtures__/after3.yml');
        $expected6 = '{' . PHP_EOL . '    host: hexlet.io' . PHP_EOL . '    - proxy: 123.234.53.22' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected6, $actual6);
    }
}

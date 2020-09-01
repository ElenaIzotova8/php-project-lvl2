<?php

namespace  Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testGenDiff()
    {
        $actual1 = genDiff('./__fixtures__/before.json', './__fixtures__/after.json');
        $expected1 = '{' . PHP_EOL . '    - follow: false' . PHP_EOL . '      host: hexlet.io' . PHP_EOL .
            '    - proxy: 123.234.53.22' . PHP_EOL . '    - timeout: 50' . PHP_EOL .
            '    + timeout: 20' . PHP_EOL . '    + verbose: true' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected1, $actual1);

        $actual2 = genDiff('./__fixtures__/before.yml', './__fixtures__/after.yml');
        $expected2 = '{' . PHP_EOL . '    - follow: false' . PHP_EOL . '      host: hexlet.io' . PHP_EOL .
            '    - proxy: 123.234.53.22' . PHP_EOL . '    - timeout: 50' . PHP_EOL .
            '    + timeout: 20' . PHP_EOL . '    + verbose: true' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected2, $actual2);
    }
}

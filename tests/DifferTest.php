<?php

namespace  Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff as genDiff;

class DifferTest extends TestCase
{
    public function testGenDiff()
    {
        $actual1 = genDiff('~/php-project-lvl2/__fixtures__/before1.json', '~/php-project-lvl2/__fixtures__/after1.json');
        $expected1 = '{' . PHP_EOL . '    host: hexlet.io' . PHP_EOL . '    + verbose: true' . PHP_EOL . '}' . PHP_EOL;
        $this->assertEquals($expected1, $actual1);
    }
}

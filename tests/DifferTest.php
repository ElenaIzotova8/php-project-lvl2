<?php

namespace  Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testGenDiff()
    {
        $actual1 = genDiff('./__fixtures__/before.json', './__fixtures__/after.json');
        $expected = file_get_contents('./__fixtures__/diff');
        $this->assertEquals($expected, $actual1);

        $actual2 = genDiff('./__fixtures__/before.yml', './__fixtures__/after.yml');
        $this->assertEquals($expected, $actual2);
    }
}

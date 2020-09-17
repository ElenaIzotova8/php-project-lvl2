<?php

namespace  Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testGenDiff()
    {
        $actual1 = genDiff('./__fixtures__/before.json', './__fixtures__/after.json');
        $expected1 = file_get_contents('./__fixtures__/diff');
        $this->assertEquals($expected1, $actual1);

        $actual2 = genDiff('./__fixtures__/before.yml', './__fixtures__/after.yml');
        $this->assertEquals($expected1, $actual2);

        $actual3 = genDiff('./__fixtures__/beforeIter.json', './__fixtures__/afterIter.json');
        $expected2 = file_get_contents('./__fixtures__/diffIter');
        $this->assertEquals($expected2, $actual3);

        $actual4 = genDiff('./__fixtures__/beforeIter.yml', './__fixtures__/afterIter.yml');
        $this->assertEquals($expected2, $actual4);

        $actual5 = genDiff('./__fixtures__/beforeIter.json', './__fixtures__/afterIter.json', 'plain');
        $expected3 = file_get_contents('./__fixtures__/diffIterPlain');
        $this->assertEquals($expected3, $actual5);

        $actual6 = genDiff('./__fixtures__/beforeIter.yml', './__fixtures__/afterIter.yml', 'plain');
        $this->assertEquals($expected3, $actual6);

        $actual7 = genDiff('./__fixtures__/beforeIter.json', './__fixtures__/afterIter.json', 'json');
        $expected4 = file_get_contents('./__fixtures__/diffIter.json');
        $this->assertEquals($expected4, $actual7);

        $actual8 = genDiff('./__fixtures__/beforeIter.yml', './__fixtures__/afterIter.yml', 'json');
        $this->assertEquals($expected4, $actual8);
    }
}

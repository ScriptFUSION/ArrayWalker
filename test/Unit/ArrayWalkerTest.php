<?php
namespace ScriptFUSIONTest\Unit\ArrayWalker;

use ScriptFUSION\ArrayWalker\ArrayWalker;

final class ArrayWalkerTest extends \PHPUnit_Framework_TestCase
{
    public function testWalkLevel1()
    {
        $level1 = ['foo' => 'bar'];

        self::assertSame($level1, ArrayWalker::walk($level1, []));
        self::assertSame('bar', ArrayWalker::walk($level1, ['foo']));
    }

    public function testWalkLevel2()
    {
        $level2 = [
            'foo' => $level1 = [
                'bar' => 'baz',
            ],
        ];

        self::assertSame($level2, ArrayWalker::walk($level2, []));
        self::assertSame($level1, ArrayWalker::walk($level2, ['foo']));
        self::assertSame('baz', ArrayWalker::walk($level2, ['foo', 'bar']));
    }
    
    public function testWalkUndefined()
    {
        $level1 = ['foo' => 'bar'];

        self::assertNull(ArrayWalker::walk($level1, ['foo', 'bar']));
        self::assertNull(ArrayWalker::walk($level1, ['bar']));
        self::assertNull(ArrayWalker::walk($level1, ['bar', 'baz']), 'Accessing child of NULL should result in NULL');
        self::assertNull(ArrayWalker::walk($level1, ['foo', 'bar', 'baz']), 'Accessing child of leaf should result in NULL');
    }
}

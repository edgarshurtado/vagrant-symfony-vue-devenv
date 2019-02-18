<?php
namespace APP\Tests\Util;

use PHPUnit\Framework\TestCase;

class PHPUnitWorksTest extends TestCase{
    public function testBooleans(){
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    public function testArrayHasKey(){
        $this->assertArrayHasKey('foo', ['foo' => 'bar']);
        $this->assertArrayNotHasKey('foo', ['bar' => 'bar']);
    }

    public function testContains(){
        $this->assertContains(4, [1,2,4]);
    }

    public function testAssertEquals(){
        $this->assertEquals(5, 5);
        $this->assertNotEquals('foo', 'bar');
    }
}
?>
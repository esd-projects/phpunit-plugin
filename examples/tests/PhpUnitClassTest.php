<?php

use GoSwoole\Plugins\PHPUnit\GoTestCase;

/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/5/9
 * Time: 14:56
 */
class PhpUnitClassTest extends GoTestCase
{
    public function testPhpUnitClassSay()
    {
        $this->assertEquals("say", "say");
    }

    public function testPhpUnitClassSay2()
    {
        $this->assertEquals("say", "s1ay");
    }
}
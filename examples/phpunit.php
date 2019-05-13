<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/5/9
 * Time: 14:51
 */

use ESD\BaseServer\ExampleClass\Server\DefaultServer;
use ESD\Plugins\PHPUnit\PHPUnitPlugin;

require __DIR__ . '/../vendor/autoload.php';


define("ROOT_DIR", __DIR__ . "/..");
define("RES_DIR", __DIR__ . "/resources");

$server = new DefaultServer();
$server->getPlugManager()->addPlug(new PHPUnitPlugin());
//配置
$server->configure();
//启动
$server->start();

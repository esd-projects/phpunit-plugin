<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/5/9
 * Time: 15:07
 */

namespace ESD\Plugins\PHPUnit;

use ESD\Core\Server\Server;

class UnitServer
{
    public $worker_id = 0;
    public $worker_pid = 0;
    public $master_pid = 0;

    public function __construct()
    {
        $this->master_pid = getmypid();
    }

    public function __call($name, $arguments)
    {

    }

    public function __get($name)
    {

    }

    public function __set($name, $value)
    {

    }

    /**
     * 调用start后会只启动一个进程
     */
    public function start()
    {
        $process = Server::$instance->getProcessManager()->getProcessFromName(PHPUnitPlugin::processName);
        $this->worker_id = $process->getProcessId();
        enableRuntimeCoroutine(true);
        $this->worker_pid = $process->getSwooleProcess()->start();
    }
}
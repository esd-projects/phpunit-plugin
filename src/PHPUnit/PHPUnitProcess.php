<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/5/9
 * Time: 15:09
 */

namespace ESD\Plugins\PHPUnit;

use ESD\Core\Message\Message;
use ESD\Core\Server\Process\Process;
use ESD\Core\Server\Server;
use PHPUnit\TextUI\Command;

class PHPUnitProcess extends Process
{
    /**
     * 在onProcessStart之前，用于初始化成员变量
     * @return mixed
     */
    public function init()
    {
        // TODO: Implement init() method.
    }

    public function onProcessStart()
    {
        $command = new Command();
        try {
            $command->run(["", Server::$instance->getContainer()->get("phpunit.file")], false);
        } catch (\Throwable $e) {
        }
        \swoole_event_exit();
        $this->getSwooleProcess()->exit();
    }

    public function onProcessStop()
    {
        // TODO: Implement onProcessStop() method.
    }

    public function onPipeMessage(Message $message, Process $fromProcess)
    {
        // TODO: Implement onPipeMessage() method.
    }
}
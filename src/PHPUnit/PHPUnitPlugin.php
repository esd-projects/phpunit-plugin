<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/5/9
 * Time: 15:04
 */

namespace GoSwoole\Plugins\PHPUnit;

use GoSwoole\BaseServer\Plugins\Config\ConfigPlugin;
use GoSwoole\BaseServer\Server\Context;
use GoSwoole\BaseServer\Server\PlugIn\AbstractPlugin;
use GoSwoole\BaseServer\Server\PlugIn\PluginInterfaceManager;
use GoSwoole\BaseServer\Server\Server;
use GoSwoole\Plugins\Console\ConsoleConfig;
use GoSwoole\Plugins\Console\ConsolePlugin;

class PHPUnitPlugin extends AbstractPlugin
{
    const processName = "unit";
    const processGroupName = "UnitGroup";

    public function __construct()
    {
        parent::__construct();
        $this->atBefore(ConsolePlugin::class);
    }

    /**
     * 获取插件名字
     * @return string
     */
    public function getName(): string
    {
        return "PHPUnit";
    }

    /**
     * @param PluginInterfaceManager $pluginInterfaceManager
     * @return mixed|void
     * @throws \GoSwoole\BaseServer\Exception
     * @throws \ReflectionException
     */
    public function onAdded(PluginInterfaceManager $pluginInterfaceManager)
    {
        parent::onAdded($pluginInterfaceManager);
        $pluginInterfaceManager->addPlug(new ConsolePlugin());
    }

    /**
     * 在服务启动前
     * @param Context $context
     * @return mixed
     * @throws \GoSwoole\BaseServer\Server\Exception\ConfigException
     * @throws \ReflectionException
     */
    public function beforeServerStart(Context $context)
    {
        //添加一个cmd
        $console = new ConsoleConfig();
        $console->addCmdClass(TestCmd::class);
        $console->merge();
        //添加一个unit进程
        $context->getServer()->addProcess(self::processName, PHPUnitProcess::class, self::processGroupName);
        return;
    }

    /**
     * 在进程启动前
     * @param Context $context
     * @return mixed
     */
    public function beforeProcessStart(Context $context)
    {
        $this->ready();
    }
}
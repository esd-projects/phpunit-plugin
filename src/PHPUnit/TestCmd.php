<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 18-1-22
 * Time: 上午10:59
 */

namespace GoSwoole\Plugins\PHPUnit;

use GoSwoole\BaseServer\Server\Context;
use GoSwoole\BaseServer\Server\Server;
use GoSwoole\Plugins\Console\ConsolePlugin;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCmd extends Command
{
    /**
     * @var Context
     */
    private $context;

    /**
     * StartCmd constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct();
        $this->context = $context;
    }

    protected function configure()
    {
        $this->setName('test')->setDescription("PHPUnit");
        $this->addArgument("file", InputArgument::OPTIONAL, "文件或者文件夹路径","tests");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     * @throws \GoSwoole\BaseServer\Server\Exception\ConfigException
     * @throws \ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $serverConfig = Server::$instance->getServerConfig();
        $serverConfig->setProxyServerClass(UnitServer::class);
        $file = $input->getArgument("file");
        Server::$instance->getContainer()->set("phpunit.file", $file);
        //添加一个unit进程
        Server::$instance->addProcess(PHPUnitPlugin::processName, PHPUnitProcess::class, PHPUnitPlugin::processGroupName);
        return ConsolePlugin::NOEXIT;
    }
}
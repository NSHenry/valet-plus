<?php

declare(strict_types=1);

namespace NSHenry\ValetPlus\Extended;

use Valet\Brew;
use Valet\CommandLine;
use Valet\Configuration;
use Valet\Filesystem;
use Valet\Status as ValetStatus;
use NSHenry\ValetPlus\Binary;
use NSHenry\ValetPlus\Mailpit;
use NSHenry\ValetPlus\Mysql;
use NSHenry\ValetPlus\Rabbitmq;
use NSHenry\ValetPlus\RedisService;
use NSHenry\ValetPlus\Varnish;

class Status extends ValetStatus
{
    /** @var Mysql */
    protected $mysql;
    /** @var Mailpit */
    protected $mailpit;
    /** @var Varnish */
    protected $varnish;
    /** @var RedisService */
    protected $redis;
    /** @var Rabbitmq */
    protected $rabbitmq;
    /** @var Binary */
    protected $binary;

    /**
     * @param Configuration $config
     * @param Brew $brew
     * @param CommandLine $cli
     * @param Filesystem $files
     * @param Mysql $mysql
     * @param Mailpit $mailpit
     * @param Varnish $varnish
     * @param RedisService $redis
     * @param Rabbitmq $rabbitmq
     */
    public function __construct(
        Configuration $config,
        Brew $brew,
        CommandLine $cli,
        Filesystem $files,
        Mysql $mysql,
        Mailpit $mailpit,
        Varnish $varnish,
        RedisService $redis,
        Rabbitmq $rabbitmq,
        Binary $binary
    ) {
        parent::__construct($config, $brew, $cli, $files);

        $this->mysql    = $mysql;
        $this->mailpit  = $mailpit;
        $this->varnish  = $varnish;
        $this->redis    = $redis;
        $this->rabbitmq = $rabbitmq;
        $this->binary   = $binary;
    }

    /**
     * Returns list of Laravel Valet and ValetPlus checks.
     *
     * @return array
     */
    public function checks(): array
    {
        $checks = parent::checks();

        $mysqlVersion = $this->mysql->installedVersion();

        $checks[] = [
            'description' => '[Valet+] Is Mysql (' . $mysqlVersion . ') installed?',
            'check'       => function () {
                return $this->mysql->installedVersion();
            },
            'debug'       => 'Run `composer require nshenry/valet-plus` and `valet-plus install`.'
        ];
        $checks[] = [
            'description' => '[Valet+] Is Mailpit installed?',
            'check'       => function () {
                return $this->mailpit->installed();
            },
            'debug'       => 'Run `composer require nshenry/valet-plus` and `valet-plus install`.'
        ];

        if ($this->varnish->installed() || $this->varnish->isEnabled()) {
            $checks[] = [
                'description' => '[Valet+] Is Varnish installed?',
                'check'       => function () {
                    return $this->varnish->installed() && $this->varnish->isEnabled();
                },
                'debug'       => 'Varnish is installed but not enabled, you might run `valet-plus varnish on`.'
            ];
            //todo; actually test something?
        }
        if ($this->redis->installed() || $this->redis->isEnabled()) {
            $checks[] = [
                'description' => '[Valet+] Is Redis installed?',
                'check'       => function () {
                    return $this->redis->installed() && $this->redis->isEnabled();
                },
                'debug'       => 'Redis is installed but not enabled, you might run `valet-plus redis on`.'
            ];
            //todo; actually test something?
        }
        if ($this->rabbitmq->installed() || $this->rabbitmq->isEnabled()) {
            $checks[] = [
                'description' => '[Valet+] Is Rabbitmq installed?',
                'check'       => function () {
                    return $this->rabbitmq->installed() && $this->rabbitmq->isEnabled();
                },
                'debug'       => 'Rabbitmq is installed but not enabled, you might run `valet-plus rabbitmq on`.'
            ];
            //todo; actually test something?
        }

        $supportedBinaries = $this->binary->getSupported();
        foreach ($supportedBinaries as $binary) {
            $checks[] = [
                'description' => '[Valet+] Is ' . $binary . ' installed?',
                'check'       => function () use ($binary) {
                    return $this->binary->installed($binary);
                },
                'debug'       => ''
            ];
        }

        return $checks;
    }
}

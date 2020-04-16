<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Phinx\Config\Config as PhinxConfig;
use Rareloop\Lumberjack\Facades\Config;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

trait LumberjackConfigProvider
{
    /**
     * Generate a Phix config from Lumberjack config.
     *
     * Inspired by https://github.com/icanhaswp/wp-phinx/blob/master/src/Console/Command/Traits/trait-wp-abstractcommand-resolver.php
     *
     * @param InputInterface  $input Input stream.
     * @param OutputInterface $output Output stream.
     * @return void
     */
    protected function loadConfig(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>using Lumberjack config settings</info> ');

        global $wpdb;

        @list($host, $port) = explode(':', DB_HOST);

        if (!$port) {
            $port = 3306;
        }

        if (!$host) {
            $host = 'localhost';
        }

        $config = [
            'paths' => [
                'migrations' => Config::get('migrations.migrations_path', get_template_directory() . '/database/migrations'),
                'seeds' => Config::get('migrations.seeds_path', get_template_directory() . '/database/seeds'),
            ],
            'environments' => [
                'default_migration_table' => $wpdb->prefix . 'phinxlog',
                'default_database' => 'wp', // Use the 'wp' environment.

                'wp' => [
                    'table_prefix' => $wpdb->prefix,
                    'adapter' => 'mysql',
                    'host' => $host,
                    'name' => DB_NAME,
                    'user' => DB_USER,
                    'pass' => DB_PASSWORD,
                    'port' => $port,
                    'charset' => DB_CHARSET,
                ],
            ],
            'version_order' => 'creation',
        ];

        $this->setConfig(new PhinxConfig($config));
    }
}

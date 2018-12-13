<?php

namespace migration\app;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Tools\Console\ConsoleRunner;
use Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Exception;
use JakubOnderka\PhpConsoleColor\ConsoleColor;
use JakubOnderka\PhpConsoleHighlighter\Highlighter;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Project: novel-migration
 *
 * Author: Nine
 * Date: 2018/12/13
 */
class Kernel
{

    const DATABASE_CONFIG = __DIR__ . '/../config/database.php';
    const MIGRATIONS_CONFIG = __DIR__ . '/../config/migrations.php';

    private $env;

    private $env_file = __DIR__ . '/../.env';

    private $hight_light = null;

    public function run($env_file = null): void
    {
        $this->registerConsole();
        if (!is_null($env_file)) {
            $this->env_file = $env_file;
        }

        if (!file_exists($this->env_file)) {
            $this->console("env file is not found.");
        } elseif (!file_exists(self::DATABASE_CONFIG)) {
            $this->console("database config file is not found.");
        } elseif (!file_exists(self::MIGRATIONS_CONFIG)) {
            $this->console("migrations config file is not found.");
        }

        $this->registerEnv();
        $this->start();
    }

    public function start()
    {
        $db_config = include self::DATABASE_CONFIG;
        $migration_config = include self::MIGRATIONS_CONFIG;
        $connection = null;
        try {
            $connection = DriverManager::getConnection($db_config);
        } catch (DBALException $e) {
            $this->console($e->getMessage());
        }
        $configuration = new Configuration($connection);
        $configuration->setName($migration_config['name']);
        $configuration->setMigrationsNamespace($migration_config['migrations_namespace']);
        $configuration->setMigrationsTableName($migration_config['table_name']);
        $configuration->setMigrationsDirectory($migration_config['migrations_directory']);

        $helper_set = new HelperSet([
            'question' => new QuestionHelper(),
            'db' => new ConnectionHelper($connection),
            new ConfigurationHelper($connection, $configuration),
        ]);
        $cli = ConsoleRunner::createApplication($helper_set);
        try {
            $cli->run();
        } catch (Exception $e) {
            $this->console($e->getMessage());
        }
    }

    public function console($content): void
    {
        if ($this->hight_light instanceof Highlighter) {
            echo $this->hight_light->getCodeSnippet($content, 1);
        } else {
            echo "hight_light need init.";
        }
        exit();
    }

    private function registerConsole(): void
    {
        $this->hight_light = new Highlighter(new ConsoleColor());
    }

    private function registerEnv(): void
    {
        $this->env = new Dotenv();
        $this->env->load($this->env_file);
    }


}
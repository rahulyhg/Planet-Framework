<?php

namespace Sun\Console\Commands;

use Sun\Console\Command;
use Sun\Contracts\Application;
use Sun\Contracts\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeConsole extends Command
{
    /**
     * @var string Command name
     */
    protected $name = 'make:console';

    /**
     * @var string Command description
     */
    protected $description = "Create a new console command";

    /**
     * @var \Sun\Contracts\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * @param Application $app
     * @param Filesystem  $filesystem
     */
    public function __construct(Application $app, Filesystem $filesystem)
    {
        parent::__construct();
        $this->app = $app;
        $this->filesystem = $filesystem;
    }

    /**
     * To handle console command
     */
    public function handle()
    {
        $consoleName  = $this->input->getArgument('name');

        $consoleNamespace = $this->getNamespace('Commands', $consoleName);

        $consoleStubs = $this->filesystem->get(__DIR__.'/../stubs/MakeConsole.txt');

        $consoleStubs = str_replace([ 'dummyConsoleCommandName', 'dummyNamespace', '\\\\' ], [ basename($consoleName), $consoleNamespace, '\\' ], $consoleStubs);

        if(!file_exists($filename = app_path() ."/Console/{$consoleName}.php")) {
            $this->filesystem->create($filename, $consoleStubs);
            $this->info("{$consoleName} console command has been created successfully.");
        } else {
            $this->info("{$consoleName} console command already exists.");
        }
    }

    /**
     * Set your command arguments
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Give a name for your console command.']
        ];
    }

    /**
     * Set your command options
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }
}
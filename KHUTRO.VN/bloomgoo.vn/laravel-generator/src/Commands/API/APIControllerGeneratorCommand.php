<?php

namespace BloomGoo\Generator\Commands\API;

use BloomGoo\Generator\Commands\BaseCommand;
use BloomGoo\Generator\Common\CommandData;
use BloomGoo\Generator\Generators\API\APIControllerGenerator;

class APIControllerGeneratorCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bloomgoo.api:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an api controller command';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->commandData = new CommandData($this, CommandData::$COMMAND_TYPE_API);
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();

        $controllerGenerator = new APIControllerGenerator($this->commandData);
        $controllerGenerator->generate();

        $this->performPostActions();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return array_merge(parent::getOptions(), []);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge(parent::getArguments(), []);
    }
}

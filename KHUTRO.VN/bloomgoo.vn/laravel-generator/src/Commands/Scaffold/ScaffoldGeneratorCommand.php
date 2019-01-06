<?php

namespace BloomGoo\Generator\Commands\Scaffold;

use BloomGoo\Generator\Commands\BaseCommand;
use BloomGoo\Generator\Common\CommandData;

class ScaffoldGeneratorCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bloomgoo:scaffold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a full CRUD views for given model';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        //dd(lấy thành công thông tin)
        $this->commandData = new CommandData($this, CommandData::$COMMAND_TYPE_SCAFFOLD);
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {

        parent::handle();// hàm này thực hiện 1 số cài đặt ban đầu vào lấy dữ liệu đầu vào (từ file or console)

        if ($this->checkIsThereAnyDataToGenerate()) {
            //buoc 1: tạo ra migration +  tạo file model + tạo file Repository;
            $this->generateCommonItems();

            //Buoc 2
            $this->generateScaffoldItems();

            $this->performPostActionsWithMigration();
        } else {

            $this->commandData->commandInfo('There isn not input fields to generate.');
        }

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

    /**
     * Check if there is anything to generate.
     *
     * @return bool
     */
    protected function checkIsThereAnyDataToGenerate()
    {
        if (count($this->commandData->fields) > 3) {
            return true;
        }
    }
}

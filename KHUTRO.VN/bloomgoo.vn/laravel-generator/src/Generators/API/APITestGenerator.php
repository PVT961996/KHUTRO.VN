<?php

namespace BloomGoo\Generator\Generators\API;

use BloomGoo\Generator\Common\CommandData;
use BloomGoo\Generator\Generators\BaseGenerator;
use BloomGoo\Generator\Utils\FileUtil;

class APITestGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $fileName;

    public function __construct(CommandData $commandData)
    {
        $this->commandData = $commandData;
        $this->path = $commandData->config->pathApiTests;
        $this->fileName = $this->commandData->modelName.'ApiTest.php';
    }

    public function generate()
    {
        $templateData = get_template('api.test.api_test', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->fileName, $templateData);

        $this->commandData->commandObj->comment("\nApiTest created: ");
        $this->commandData->commandObj->info($this->fileName);
    }

    public function rollback()
    {
        if ($this->rollbackFile($this->path, $this->fileName)) {
            $this->commandData->commandComment('API Test file deleted: '.$this->fileName);
        }
    }
}
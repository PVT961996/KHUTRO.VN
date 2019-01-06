<?php

namespace BloomGoo\Generator\Common;

use Exception;
use Illuminate\Console\Command;
use BloomGoo\Generator\Utils\GeneratorFieldsInputUtil;
use BloomGoo\Generator\Utils\TableFieldsGenerator;

class CommandData                // lấy dữ liệu từ file json  114
{
    public static $COMMAND_TYPE_API = 'api';
    public static $COMMAND_TYPE_SCAFFOLD = 'scaffold';
    public static $COMMAND_TYPE_API_SCAFFOLD = 'api_scaffold';
    public static $COMMAND_TYPE_VUEJS = 'vuejs';

    /** @var string */
    public $modelName;
    public $commandType;

    /** @var GeneratorConfig */
    public $config;
    /** @var mảng đối tượng GeneratorField[] */
    public $fields = [];

    /** @var mảng đối tượng GeneratorFieldRelation[] */
    public $relations = [];

    /** @var Command */
    public $commandObj;

    /** @var array */
    public $dynamicVars = [];
    public $fieldNamesMapping = [];

    /** @var CommandData */
    protected static $instance = null;

    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * @param Command $commandObj
     * @param string  $commandType
     *
     * @return CommandData
     */
    public function __construct(Command $commandObj, $commandType)
    {
        $this->commandObj = $commandObj;
        $this->commandType = $commandType;

        $this->fieldNamesMapping = [
            '$FIELD_NAME_TITLE$' => 'fieldTitle',
            '$FIELD_NAME$'       => 'name',
        ];

        $this->config = new GeneratorConfig();
    }

    public function commandError($error)
    {
        $this->commandObj->error($error);
    }

    public function commandComment($message)
    {
        $this->commandObj->comment($message);
    }

    public function commandWarn($warning)
    {
        $this->commandObj->warn($warning);
    }

    public function commandInfo($message)         //đưa thông báo trên console
    {
        $this->commandObj->info($message);
    }

    public function initCommandData()
    {
        $this->config->init($this);
    }

    public function getOption($option)
    {
        return $this->config->getOption($option);
    }

    public function getAddOn($option)
    {
        return $this->config->getAddOn($option);
    }

    public function setOption($option, $value)
    {
        $this->config->setOption($option, $value);
    }

    public function addDynamicVariable($name, $val)
    {
        $this->dynamicVars[$name] = $val;
    }

    public function getFields()
    {
        $this->fields = [];

        if ($this->getOption('fieldsFile') or $this->getOption('jsonFromGUI')) {
            //lấy dữ liệu từ file : cập nhật cho fields khai báo ở trên
            $this->getInputFromFileOrJson();
        } elseif ($this->getOption('fromTable')) {
            $this->getInputFromTable();
        } else {
            $this->getInputFromConsole();
        }
    }

    private function getInputFromFileOrJson() // ham này cập nhật biến fields của lớp
    {
        // fieldsFile option will get high priority than json option if both options are passed
        try {
            if ($this->getOption('fieldsFile')) {
                $fieldsFileValue = $this->getOption('fieldsFile');
                if (file_exists($fieldsFileValue)) {
                    $filePath = $fieldsFileValue;
                } elseif (file_exists(base_path($fieldsFileValue))) {
                    $filePath = base_path($fieldsFileValue);
                } else {
                    $schemaFileDirector = config('bloomgoo.laravel_generator.path.schema_files');
                    $filePath = $schemaFileDirector.$fieldsFileValue;
                }

                if (!file_exists($filePath)) {
                    $this->commandError('Fields file not found');
                    exit;
                }
// lấy nội dung file đầu vào
                $fileContents = file_get_contents($filePath);

                $jsonData = json_decode($fileContents, true);
                /* Nội dung của $jsonData
                 * array:2 [
                      0 => array:4 [
                        "name" => "writer_id"
                        "dbType" => "integer:unsigned:foreign,writers,id"
                        "htmlType" => "text"
                        "relation" => "mt1,Writer,writer_id,id"
                      ]
                      1 => array:9 [
                        "name" => "title"
                        "dbType" => "string,50"
                        "htmlType" => "text"
                        "validations" => "required"
                        "searchable" => true
                        "fillable" => true
                        "primary" => false
                        "inForm" => true
                        "inIndex" => true
                      ]
                    ]

                 *
                 * */

                $this->fields = [];
                foreach ($jsonData as $field) {
                    /* Nội dung của field là 1 phần tử của mảng $jsonData
                    Ví dụ: Phần tử $jsonData[1] và jsonData[0]
                        1 => array:9 [
                        "name" => "title"
                        "dbType" => "string,50"
                        "htmlType" => "text"
                        "validations" => "required"
                        "searchable" => true
                        "fillable" => true
                        "primary" => false
                        "inForm" => true
                        "inIndex" => true
                      ]
                    0 => array:4 [
                        "name" => "writer_id"
                        "dbType" => "integer:unsigned:foreign,writers,id"
                        "htmlType" => "text"
                        "relation" => "mt1,Writer,writer_id,id"
                      ]
                     **/
                    if (isset($field['type']) && $field['relation']) {
                        //Neeus type vaf relation đồng thời được định nghĩa.
                        //Thêm vào mảng relations

                        $this->relations[] = GeneratorFieldRelation::parseRelation($field['relation']);
                    } else {
                        //fields thêm các đối tượng GeneratorField vào mảng fields
                        $this->fields[] = GeneratorField::parseFieldFromFile($field);

                        if (isset($field['relation'])) {
                            //($field['relation'])  có dạng  mt1,Writer,writer_id,id"
                            $this->relations[] = GeneratorFieldRelation::parseRelation($field['relation']);

                            /*
                             * parseRelation trả về dạng dữ liệu đối tượng dạng:(2 đối tượng type và inputs)
                             *  * +type: "mt1"
                                  +inputs: array:3 [
                                    0 => "Writer"
                                    1 => "writer_id"
                                    2 => "id"
                                  ]
                             * */
                        }
                    }
                }

            } else {

                $fileContents = $this->getOption('jsonFromGUI');
                $jsonData = json_decode($fileContents, true);
                foreach ($jsonData['fields'] as $field) {
                    if (isset($field['type']) && $field['relation']) {
                        $this->relations[] = GeneratorFieldRelation::parseRelation($field['relation']);
                    } else {
                        $this->fields[] = GeneratorField::parseFieldFromFile($field);
                        if (isset($field['relation'])) {
                            $this->relations[] = GeneratorFieldRelation::parseRelation($field['relation']);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $this->commandError($e->getMessage());
            exit;
        }
    }

    //lấy dữ liệu qua console
    private function getInputFromConsole()
    {
        $this->commandInfo('Specify fields for the model (skip id & timestamp fields, we will add it automatically)');
        $this->commandInfo('Read docs carefully to specify field inputs)');
        $this->commandInfo('Enter "exit" to finish');

        $this->addPrimaryKey();

        while (true) {
            $fieldInputStr = $this->commandObj->ask('Field: (name db_type html_type options)', '');

            if (empty($fieldInputStr) || $fieldInputStr == false || $fieldInputStr == 'exit') {
                break;
            }

            if (!GeneratorFieldsInputUtil::validateFieldInput($fieldInputStr)) {
                $this->commandError('Invalid Input. Try again');
                continue;
            }

            $validations = $this->commandObj->ask('Enter validations: ', false);
            $validations = ($validations == false) ? '' : $validations;

            if ($this->getOption('relations')) {
                $relation = $this->commandObj->ask('Enter relationship (Leave Black to skip):', false);
            } else {
                $relation = '';
            }

            $this->fields[] = GeneratorFieldsInputUtil::processFieldInput(
                $fieldInputStr,
                $validations
            );

            if (!empty($relation)) {
                $this->relations[] = GeneratorFieldRelation::parseRelation($relation);
            }
        }

        $this->addTimestamps();
    }

    private function addPrimaryKey()
    {
        $primaryKey = new GeneratorField();
        if ($this->getOption('primary')) {
            $primaryKey->name = $this->getOption('primary');
        } else {
            $primaryKey->name = 'id';
        }
        $primaryKey->parseDBType('increments');
        $primaryKey->parseOptions('s,f,p,if,ii');

        $this->fields[] = $primaryKey;
    }

    private function addTimestamps()
    {
        $createdAt = new GeneratorField();
        $createdAt->name = 'created_at';
        $createdAt->parseDBType('timestamp');
        $createdAt->parseOptions('s,f,if,ii');
        $this->fields[] = $createdAt;

        $updatedAt = new GeneratorField();
        $updatedAt->name = 'updated_at';
        $updatedAt->parseDBType('timestamp');
        $updatedAt->parseOptions('s,f,if,ii');
        $this->fields[] = $updatedAt;
    }



    private function getInputFromTable()
    {
        $tableName = $this->dynamicVars['$TABLE_NAME$'];

        $tableFieldsGenerator = new TableFieldsGenerator($tableName);
        $tableFieldsGenerator->prepareFieldsFromTable();
        $tableFieldsGenerator->prepareRelations();

        $this->fields = $tableFieldsGenerator->fields;
        $this->relations = $tableFieldsGenerator->relations;
    }
}

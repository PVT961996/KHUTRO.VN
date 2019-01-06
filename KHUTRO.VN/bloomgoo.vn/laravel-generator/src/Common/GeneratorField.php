<?php

namespace BloomGoo\Generator\Common;

use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\Helper;

class GeneratorField                // tao file migrate
{
    /** @var string */
    public $name;
    public $dbInput;
    public $htmlInput;
    public $htmlType;
    public $fieldType;

    /** @var array */
    public $htmlValues;

    /** @var string */
    public $migrationText;
    public $foreignKeyText;
    public $validations;
    /* Thêm mới slug: true false ;
     * các validate khác cần định dạng: mail, sđt ...
     * Giá trị mặc định
     * */
    public $slug;
    public $validateOther;
    public $default;
    /** @var bool */
    public $isSearchable = true;
    public $isFillable = true;
    public $isPrimary = false;
    public $inForm = true;
    public $inIndex = true;

    public function parseDBType($dbInput,$validate=[],$default='')
    {
        $this->dbInput = $dbInput;
        $this->prepareMigrationText($validate,$default);
    }



    public function parseValidateOther($inputValidateOther){
        $this->validateOther=[];
        $inputsArr = explode(',', $inputValidateOther);
        foreach ($inputsArr as $input){
            $elements = explode(':', $input);
            if(count($elements)==2){
                $this->validateOther[$elements[0]]=$elements[1];
            }
        }
    }

    public function parseHtmlInput($htmlInput)
    {
        $this->htmlInput = $htmlInput;
        $this->htmlValues = [];

        if (empty($htmlInput)) {
            $this->htmlType = 'text';

            return;
        }

        $inputsArr = explode(',', $htmlInput);

        $this->htmlType = array_shift($inputsArr);

        if (count($inputsArr) > 0) {
            $this->htmlValues = $inputsArr;
        }
    }

    public function parseOptions($options)
    {
        $options = strtolower($options);
        $optionsArr = explode(',', $options);
        if (in_array('s', $optionsArr)) {
            $this->isSearchable = false;
        }
        if (in_array('p', $optionsArr)) {
            // if field is primary key, then its not searchable, fillable, not in index & form
            $this->isPrimary = true;
            $this->isSearchable = false;
            $this->isFillable = false;
            $this->inForm = false;
            $this->inIndex = false;
        }
        if (in_array('f', $optionsArr)) {
            $this->isFillable = false;
        }
        if (in_array('if', $optionsArr)) {
            $this->inForm = false;
        }
        if (in_array('ii', $optionsArr)) {
            $this->inIndex = false;
        }
    }

    private function prepareMigrationText($validate=[],$default='')
    {
        $inputsArr = explode(':', $this->dbInput);

        $this->migrationText = '$table->';

        $fieldTypeParams = explode(',', array_shift($inputsArr));

        $this->fieldType = array_shift($fieldTypeParams);

        $this->migrationText .= $this->fieldType."('".$this->name."'";

        if ($this->fieldType == 'enum') {
            $this->migrationText .= ', [';
            foreach ($fieldTypeParams as $param) {
                $this->migrationText .= "'".$param."',";
            }
            $this->migrationText = substr($this->migrationText, 0, strlen($this->migrationText) - 1);
            $this->migrationText .= ']';
        } else {
            //Them max lenght: trong truong hop dbType khong co maxlenght mà trong validate lại có thì lấy bên validate
            if(count($fieldTypeParams)==0){ // không có maxlenght
                if(isset($validate['max'])){
                    $this->migrationText.=','.$validate['max'];
                }
            }else{
                foreach ($fieldTypeParams as $param) {
                    $this->migrationText .= ', '.$param;
                }
            }
        }

        $this->migrationText .= ')';
        //them thuoc tinh o day nullable()
        if(!isset($validate['required'])){
            $this->migrationText .= '->nullable()';
        }
        // Thêm giá trị mặc định
        if($default!=''){
            if(is_string($default)){
                $this->migrationText .= '->default('."'".$default."'".')';
            }
            else{
                $this->migrationText .= '->default('.$default.')';
            }

        }

        foreach ($inputsArr as $input) {
            $inputParams = explode(',', $input);
            $functionName = array_shift($inputParams);
            if ($functionName == 'foreign') {
                $foreignTable = array_shift($inputParams);
                $foreignField = array_shift($inputParams);
                $this->foreignKeyText .= "\$table->foreign('".$this->name."')->references('".$foreignField."')->on('".$foreignTable."');";
            } else {
                $this->migrationText .= '->'.$functionName;
                $this->migrationText .= '(';
                $this->migrationText .= implode(', ', $inputParams);
                // them maxlenght
                $this->migrationText .= ')';
            }
        }


        $this->migrationText .= ';';

    }

    public static function parseFieldFromFile($fieldInput)
    {
        $field = new self();
        $field->name = $fieldInput['name'];
        $val = isset($fieldInput['validations'])? $fieldInput['validations'] : '';
        $field->parseHtmlInput(isset($fieldInput['htmlType']) ? $fieldInput['htmlType'] : '');
        $field->validations = $val!='' ? $val : '';
        $field->isSearchable = isset($fieldInput['searchable']) ? $fieldInput['searchable'] : false;
        $field->isFillable = isset($fieldInput['fillable']) ? $fieldInput['fillable'] : true;
        $field->isPrimary = isset($fieldInput['primary']) ? $fieldInput['primary'] : false;
        $field->inForm = isset($fieldInput['inForm']) ? $fieldInput['inForm'] : true;
        $field->inIndex = isset($fieldInput['inIndex']) ? $fieldInput['inIndex'] : true;
        $field->slug = isset($fieldInput['slug']) ? $fieldInput['slug'] : false;
        $field->default = isset($fieldInput['default']) ? $fieldInput['default'] : '';
        $field->parseDBType($fieldInput['dbType'],parseArrValidate($val),$field->default);
        if(isset($fieldInput['validateOther'])){
            $field->parseValidateOther($fieldInput['validateOther']);
        }


        /*
         * dạng trả về : field: là đối tượng class hiện tại
         * BloomGoo\Generator\Common\GeneratorField {#841
          +name: "writer_id"
          +dbInput: "integer:unsigned:foreign,writers,id"
          +htmlInput: "text"
          +htmlType: "text"
          +fieldType: "integer"
          +htmlValues: []
          +migrationText: "$table->integer('writer_id')->unsigned();"
          +foreignKeyText: "$table->foreign('writer_id')->references('id')->on('writers');"
          +validations: ""
          +isSearchable: false
          +isFillable: true
          +isPrimary: false
          +inForm: true
          +inIndex: true
          }
         * */

        return $field;
    }

    public function __get($key)
    {
        if ($key == 'fieldTitle') {
            return Str::title(str_replace('_', ' ', $this->name));
        }

        return $this->$key;
    }
}

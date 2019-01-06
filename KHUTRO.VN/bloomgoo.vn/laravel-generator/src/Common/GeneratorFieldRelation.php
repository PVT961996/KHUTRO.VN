<?php

namespace BloomGoo\Generator\Common;
use BloomGoo\Generator\Common\CommandData;

class GeneratorFieldRelation
{
    /** @var string */
    public $type;
    public $inputs;    //dạng mảng như : +inputs: array:3 [
                //0 => "Writer"
                //1 => "writer_id"
               // 2 => "id"
               // ]

    public static function parseRelation($relationInput)
    {
        // đầu vào: 'mt1,Writer,writer_id,id'
        $inputs = explode(',', $relationInput);

        $relation = new self();
        $relation->type = array_shift($inputs);
        $relation->inputs = $inputs;
        /*   dữ liệu relation có dạng($relations là một đối tượng GeneratorFieldRelation)
         * +type: "mt1"
          +inputs: array:3 [
            0 => "Writer"
            1 => "writer_id"
            2 => "id"
          ]

         * */
        return $relation;
    }

    public function getRelationFunctionText($model='',$relationModelName=''){  // ten model de so sanh ten ham neu trung nhau chuyen sang parent
          //dạng mảng như : +inputs: array:3 [
                //0 => "Writer"
                //1 => "writer_id"
               // 2 => "id"
               // ]
        $modelName = $this->inputs[0];
        switch ($this->type) {
            case '1t1':
                $functionName = camel_case($modelName);
                $relation = 'hasOne';
                $relationClass = 'HasOne';
                break;
            case '1tm':
                $functionName = camel_case(str_plural($modelName));
                $relation = 'hasMany';
                $relationClass = 'HasMany';
                break;
            case 'mt1':
                $functionName = camel_case($modelName);
                $relation = 'belongsTo';
                $relationClass = 'BelongsTo';
                break;
            case 'mtm':
                $functionName = camel_case(str_plural($modelName));
                $relation = 'belongsToMany';
                $relationClass = 'BelongsToMany';
                break;
            case 'hmt':
                $functionName = camel_case(str_plural($modelName));
                $relation = 'hasManyThrough';
                $relationClass = 'HasManyThrough';
                break;
            default:
                $functionName = '';
                $relation = '';
                $relationClass = '';
                break;
        }

        if (!empty($functionName) and !empty($relation)) {
            if($model==='children'){
                $relation = 'hasMany';
                $relationClass = 'HasMany';
                $functionName='children';
                return $this->generateRelation($functionName, $relation, $relationClass,$relationModelName);
            }
            if($model===$functionName){
                $functionName='parent';
                return $this->generateRelation($functionName, $relation, $relationClass);
            }
            return $this->generateRelation($functionName, $relation, $relationClass);
        }

        return '';
    }

    private function generateRelation($functionName, $relation, $relationClass,$relationModelName='')
    {
        $inputs = $this->inputs;
        $modelName = array_shift($inputs);


        if($functionName==='children'){
            $template = get_template('model.relationshipChild', 'laravel-generator');
            $template = str_replace('$RELATION_MODEL_NAME$', $relationModelName, $template);
        }
        else{
            $template = get_template('model.relationship', 'laravel-generator');
        }

        $template = str_replace('$RELATIONSHIP_CLASS$', $relationClass, $template);
        $template = str_replace('$FUNCTION_NAME$', $functionName, $template);
        $template = str_replace('$RELATION$', $relation, $template);
        $template = str_replace('$RELATION_MODEL_NAME$', $modelName, $template);

        if (count($inputs) > 0) {
            $inputFields = implode("', '", $inputs);
            $inputFields = ", '".$inputFields."'";
        } else {
            $inputFields = '';
        }

        $template = str_replace('$INPUT_FIELDS$', $inputFields, $template);

        return $template;
    }

    private function generateSlug($fieldSlug)
    {
        $template = get_template('slug.slug', 'laravel-generator');


        $template = str_replace('$FIELD_SLUG$',$fieldSlug,$template);

        dd($template);
        return $template;
    }

}

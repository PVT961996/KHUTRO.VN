<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('infy_tab')) {
    /**
     * Generates tab with spaces.
     *
     * @param int $spaces
     *
     * @return string
     */
    function infy_tab($spaces = 4)
    {
        return str_repeat(' ', $spaces);
    }
}

if (!function_exists('infy_tabs')) {
    /**
     * Generates tab with spaces.
     *
     * @param int $tabs
     * @param int $spaces
     *
     * @return string
     */
    function infy_tabs($tabs, $spaces = 4)
    {
        return str_repeat(infy_tab($spaces), $tabs);
    }
}

if (!function_exists('infy_nl')) {
    /**
     * Generates new line char.
     *
     * @param int $count
     *
     * @return string
     */
    function infy_nl($count = 1)
    {
        return str_repeat(PHP_EOL, $count);
    }
}

if (!function_exists('infy_nls')) {
    /**
     * Generates new line char.
     *
     * @param int $count
     * @param int $nls
     *
     * @return string
     */
    function infy_nls($count, $nls = 1)
    {
        return str_repeat(infy_nl($nls), $count);
    }
}

if (!function_exists('infy_nl_tab')) {
    /**
     * Generates new line char.
     *
     * @param int $lns
     * @param int $tabs
     *
     * @return string
     */
    function infy_nl_tab($lns = 1, $tabs = 1)
    {
        return infy_nls($lns).infy_tabs($tabs);
    }
}

if (!function_exists('get_template_file_path')) {
    /**
     * get path for template file.
     *
     * @param string $templateName
     * @param string $templateType
     *
     * @return string
     */
    function get_template_file_path($templateName, $templateType)
    {
        $templateName = str_replace('.', '/', $templateName);

        $templatesPath = config(
            'bloomgoo.laravel_generator.path.templates_dir',
            base_path('resources/bloomgoo/bloomgoo-generator-templates/')
        );

        $path = $templatesPath.$templateName.'.stub';

        if (file_exists($path)) {
            return $path;
        }

        return base_path('bloomgoo.vn/'.$templateType.'/templates/'.$templateName.'.stub');
    }
}

if (!function_exists('get_template')) {
    /**
     * get template contents.
     *
     * @param string $templateName
     * @param string $templateType
     *
     * @return string
     */
    function get_template($templateName, $templateType)
    {
        $path = get_template_file_path($templateName, $templateType);

        return file_get_contents($path);
    }
}

if (!function_exists('fill_template')) {
    /**
     * fill template with variable values.
     *
     * @param array  $variables
     * @param string $template
     *
     * @return string
     */
    function fill_template($variables, $template)
    {

        foreach ($variables as $variable => $value) {
            $template = str_replace($variable, $value, $template);
        }


        return $template;
    }
}

if (!function_exists('fill_field_template')) {
    /**
     * fill field template with variable values.
     *
     * @param array                                   $variables
     * @param string                                  $template
     * @param \BloomGoo\Generator\Common\GeneratorField $field
     *
     * @return string
     */
    function fill_field_template($variables, $template, $field)
    {
        foreach ($variables as $variable => $key) {
            $template = str_replace($variable, $field->$key, $template);
        }

        return $template;
    }
}

if (!function_exists('fill_template_with_field_data')) {
    /**
     * fill template with field data.
     *
     * @param array                                   $variables
     * @param array                                   $fieldVariables
     * @param string                                  $template
     * @param \BloomGoo\Generator\Common\GeneratorField $field
     *
     * @return string
     */
    function fill_template_with_field_data($variables, $fieldVariables, $template, $field)
    {
        $template = fill_template($variables, $template);

        return fill_field_template($fieldVariables, $template, $field);
    }
}

if (!function_exists('fill_template_with_field_data')) {
    /**
     * fill template with field data.
     *
     * @param array                                   $variables
     * @param array                                   $fieldVariables
     * @param string                                  $template
     * @param \BloomGoo\Generator\Common\GeneratorField $field
     *
     * @return string
     */
    function fill_template_with_field_data($variables, $fieldVariables, $template, $field)
    {
        $template = fill_template($variables, $template);

        return fill_field_template($fieldVariables, $template, $field);
    }
}

if (!function_exists('model_name_from_table_name')) {
    /**
     * generates model name from table name.
     *
     * @param string $tableName
     *
     * @return string
     */
    function model_name_from_table_name($tableName)
    {
        return ucfirst(camel_case(str_singular($tableName)));
    }
}
if (!function_exists('parseArrValidate')) {
    function parseArrValidate($inputValidate){
        $arrValidate=[];
        $inputsArr = explode(',', $inputValidate);
        foreach ($inputsArr as $input){
            $elements = explode(':', $input);
            if(count($elements)==1){
                $arrValidate[$elements[0]]=$elements[0];
            }elseif (count($elements)==2){
                $arrValidate[$elements[0]]=$elements[1];
            }
        }
        return $arrValidate;
    }
}

function hasRole($table, $action){
    if (Auth::check()){
        $userId = Auth::user()->id;

        $model_table = DB::table('tables')->where('name', '=', $table)->whereNull('deleted_at')->get();
        if(count($model_table) > 0){
            $tableId = $model_table->first()->id;
        }else
            return false;

        $model_action = DB::table('actions')->where('name', '=', $action)->whereNull('deleted_at')->get();
        if(count($model_table) > 0)
            $actionId = $model_action->first()->id;
        else
            return false;

        if($tableId == null || $actionId == null)
            return false;

        $menuId = DB::table('menus')->where([['action_id', '=', $actionId],['table_id', '=', $tableId]])->select('id')->first()->id;
        $user_menu = DB::table('user_menus')->where([['user_id', '=', $userId],['menu_id', '=', $menuId]])->whereNull('deleted_at')->get();
        if (count($user_menu) > 0){
            return true;
        }
        return false;
    }
}

if (! function_exists('toStringOf')) {
    function toStringOf($objs,$attr,$typeLink='',$link=''){
        $rs='';
        if($typeLink==='show'){
            foreach ($objs as $obj){
                $rs.="<a href=".route($link, [$obj->id]).">".$obj->$attr.'</a>'.', ';
            }
        }
        else{
            foreach ($objs as $obj){
                $rs.=$obj->$attr.', ';
            }
        }
        return substr($rs,0,strlen($rs)-2);
    }
}

if (! function_exists('inArrObj')) {
    function inArrObj($id, $objs){
        foreach ($objs as $obj){
            if($id==$obj->id){
                return true;
            }
        }
        return false;
    }
}

if (! function_exists('inArr')) {
    function inArr($e, $arr){
        foreach ($arr as $element){
            if($element==$e){
                return true;
            }
        }
        return false;
    }
}


if (! function_exists('formatPrice')) {
    function fomatPrice($price){
       if($price>=1000000){
           $p = $price/1000000;
           return $p.' triệu';
       }
       elseif ($price>=100000){
           $p = $price/100000;
           return $p.' nghìn';
       }
       else{
           return $price.'đ';
       }
    }
}

if (! function_exists('makeLinks')) {
    function makeLinks($str)
    {
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";
        $urls = array();
        $urlsToReplace = array();
        if (preg_match_all($reg_exUrl, $str, $urls)) {
            $numOfMatches = count($urls[0]);
            $numOfUrlsToReplace = 0;
            for ($i = 0; $i < $numOfMatches; $i++) {
                $alreadyAdded = false;
                $numOfUrlsToReplace = count($urlsToReplace);
                for ($j = 0; $j < $numOfUrlsToReplace; $j++) {
                    if ($urlsToReplace[$j] == $urls[0][$i]) {
                        $alreadyAdded = true;
                    }
                }
                if (!$alreadyAdded) {
                    array_push($urlsToReplace, $urls[0][$i]);
                }
            }
            $numOfUrlsToReplace = count($urlsToReplace);
            for ($i = 0; $i < $numOfUrlsToReplace; $i++) {
                $str = str_replace($urlsToReplace[$i], "<a href=\"" . $urlsToReplace[$i] . "\">" . "<i class=\"glyphicon glyphicon-download-alt\"></i>" . "</a>", $str);
            }
            return $str;
        } else {
            return $str;
        }
    }
}

if (! function_exists('rip_tags')) {
    function rip_tags($string)
    {
        $string = preg_replace('/<[^>]*>/', ' ', $string);

        // ----- remove control characters -----
        $string = str_replace("\r", '', $string);    // --- replace with empty space
        $string = str_replace("\n", ' ', $string);   // --- replace with space
        $string = str_replace("\t", ' ', $string);   // --- replace with space

        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));

        return $string;

    }
}

if (! function_exists('transText')) {
    function transText($vnStr, $seperator = "_")
    {
// In thường
        $vnStr = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $vnStr);
        $vnStr = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $vnStr);
        $vnStr = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $vnStr);
        $vnStr = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $vnStr);
        $vnStr = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $vnStr);
        $vnStr = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $vnStr);
        $vnStr = preg_replace("/(đ)/", 'd', $vnStr);
// In đậm
        $vnStr = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $vnStr);
        $vnStr = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $vnStr);
        $vnStr = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $vnStr);
        $vnStr = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $vnStr);
        $vnStr = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $vnStr);
        $vnStr = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $vnStr);
        $vnStr = preg_replace("/(Đ)/", 'D', $vnStr);
// Chuyển dấu cách thành _
        $vnStr = preg_replace("/ /", $seperator, $vnStr);
// Bỏ đi 2 dấu ()
        $vnStr = preg_replace("/\(|\)/", "", $vnStr);
        return strtolower($vnStr); // Trả về chuỗi đã chuyển
    }
}
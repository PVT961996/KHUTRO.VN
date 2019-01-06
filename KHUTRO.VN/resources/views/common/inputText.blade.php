<div class="form-group col-sm-6">
    @if(isset($valueInputText)&&count($valueInputText)>0)
        <label for={{$fieldConfigCategory->field_name}}>{{$fieldConfigCategory->label_html}}</label>
        <input class="form-control" name="fields[{{$fieldConfigCategory->field_name}}]" type="text" value="{{$valueInputText[0]}}">
    @else
        <label for={{$fieldConfigCategory->field_name}}>{{$fieldConfigCategory->label_html}}</label>
        <input class="form-control" name="fields[{{$fieldConfigCategory->field_name}}]" type="text" >
    @endif

</div>
<br>
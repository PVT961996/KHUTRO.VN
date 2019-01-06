<div class="form-group col-sm-6">
    @if(isset($valueInputNumber)&&count($valueInputNumber)>0)
        <label for={{$fieldConfigCategory->field_name}}>{{$fieldConfigCategory->label_html}}</label>
        <input class="form-control" name="fields[{{$fieldConfigCategory->field_name}}]" type="number" value="{{$valueInputNumber[0]}}">
    @else
        <label for={{$fieldConfigCategory->field_name}}>{{$fieldConfigCategory->label_html}}</label>
        <input class="form-control" name="fields[{{$fieldConfigCategory->field_name}}]" type="number" >
    @endif
</div>
<br>
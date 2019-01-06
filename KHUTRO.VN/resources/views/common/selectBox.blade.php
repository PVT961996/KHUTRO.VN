<div class={{$fieldConfigCategory->class_css}} >
    @if(isset($valueSelectBox)&&count($valueSelectBox)>0)
        <label for={{$fieldConfigCategory->field_name}}>{{$fieldConfigCategory->label_html}}</label>
        <select class="form-control config_price" name="{{$fieldConfigCategory->field_name}}">
            @foreach($options as $option)
                @if(inArr($option==$valueSelectBox[0]))
                    <option selected="selected" value={{$option}}>{{$option}}</option>
                @else
                    <option value={{$option}}>{{$option}}</option>
                @endif
            @endforeach
        </select>
    @else
        <label for={{$fieldConfigCategory->field_name}}>{{$fieldConfigCategory->label_html}}</label>
        {!! Form::select($fieldConfigCategory->field_name, $options, null, ['class'=> 'form-control']) !!}
    @endif
</div>
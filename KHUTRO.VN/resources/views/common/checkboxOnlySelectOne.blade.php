<div class="form-group col-sm-6">
    <label>{{$fieldConfigCategory->label_html}}</label><br>
    @if(isset($valuesCheckboxOnlySelectOne)&&count($valuesCheckboxOnlySelectOne)>0)
        @foreach($options as $option)
            @if(inArr($option,$valuesCheckboxOnlySelectOne))
                <label><input type="checkbox" checked name="{{'fields['.$fieldConfigCategory->field_name.'][]'}}" value="{{ $option }}" class="icheck {{$fieldConfigCategory->field_name}}-2"> {{$option}} </label><br>
            @else
                <label><input type="checkbox" name="{{'fields['.$fieldConfigCategory->field_name.'][]'}}" value="{{ $option }}" class="icheck {{$fieldConfigCategory->field_name}}-2"> {{$option}} </label><br>
            @endif
        @endforeach
    @else
        @foreach($options as $option)
            <label><input type="checkbox" name="{{'fields['.$fieldConfigCategory->field_name.'][]'}}" value="{{ $option }}" class="icheck {{$fieldConfigCategory->field_name}}-2"> {{$option}} </label><br>
        @endforeach
    @endif
</div>
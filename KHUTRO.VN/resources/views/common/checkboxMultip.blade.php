<label>{{$fieldConfigCategory->label_html}}</label><br>
@if(isset($valuesCheckboxMultip)&&count($valuesCheckboxMultip)>0)
    @foreach($options as $option)
        @if(inArr($option,$valuesCheckboxMultip))
            <label><input type="checkbox" checked name="{{'fields['.$fieldConfigCategory->field_name.'][]'}}" value="{{ $option }}" class="icheck"> {{$option}} </label><br>
        @else
            <label><input type="checkbox" name="{{'fields['.$fieldConfigCategory->field_name.'][]'}}" value="{{ $option }}" class="icheck"> {{$option}} </label><br>
        @endif
    @endforeach
@else
    @foreach($options as $option)
        <label><input type="checkbox" name="{{'fields['.$fieldConfigCategory->field_name.'][]'}}" value="{{ $option }}" class="icheck"> {{$option}} </label><br>
    @endforeach
@endif
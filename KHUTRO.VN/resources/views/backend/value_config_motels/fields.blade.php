<!-- Config Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('config_category_id', 'Config Category Id:') !!}
    {!! Form::text('config_category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::text('value', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {!! Form::submit('Save', ['class' => 'btn green']) !!}
            <a href="{!! route('admin.valueConfigMotels.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

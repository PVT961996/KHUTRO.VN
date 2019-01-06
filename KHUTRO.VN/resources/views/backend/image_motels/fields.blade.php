<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Motel Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('motel_id', 'Motel Id:') !!}
    {!! Form::text('motel_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {!! Form::submit('Save', ['class' => 'btn green']) !!}
            <a href="{!! route('admin.imageMotels.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

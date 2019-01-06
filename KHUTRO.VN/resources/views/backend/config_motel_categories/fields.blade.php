<!-- Field Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('field_name', 'Field Name:') !!}
    {!! Form::text('field_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Motel Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('motel_category_id', 'Motel Category Id:') !!}
    {!! Form::text('motel_category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Html Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('html_type', 'Html Type:') !!}
    {!! Form::text('html_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Db Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('db_type', 'Db Type:') !!}
    {!! Form::text('db_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Default Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('default_value', 'Default Value:') !!}
    {!! Form::text('default_value', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', 'Location:') !!}
    {!! Form::text('location', null, ['class' => 'form-control']) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::text('icon', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Class Css Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_css', 'Class Css:') !!}
    {!! Form::text('class_css', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {!! Form::submit('Save', ['class' => 'btn green']) !!}
            <a href="{!! route('admin.configMotelCategories.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

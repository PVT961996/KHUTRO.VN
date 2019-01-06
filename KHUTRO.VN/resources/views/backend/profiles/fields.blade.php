<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Motel Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('motel_category_id', 'Motel Category Id:') !!}
    {!! Form::text('motel_category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Short Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::text('short_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image_title', 'Image Title:') !!}
    {!! Form::text('image_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Area Field -->
<div class="form-group col-sm-6">
    {!! Form::label('area', 'Area:') !!}
    {!! Form::number('area', null, ['class' => 'form-control']) !!}
</div>

<!-- Province Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('province_id', 'Province Id:') !!}
    {!! Form::text('province_id', null, ['class' => 'form-control']) !!}
</div>

<!-- District Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district_id', 'District Id:') !!}
    {!! Form::text('district_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Town Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('town_id', 'Town Id:') !!}
    {!! Form::text('town_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-6">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Seo Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seo_title', 'Seo Title:') !!}
    {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Seo Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seo_tag', 'Seo Tag:') !!}
    {!! Form::text('seo_tag', null, ['class' => 'form-control']) !!}
</div>

<!-- Seo Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seo_description', 'Seo Description:') !!}
    {!! Form::text('seo_description', null, ['class' => 'form-control']) !!}
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
            <a href="{!! route('admin.profiles.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

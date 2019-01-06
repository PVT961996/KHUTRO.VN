<!-- Post Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_category_id', 'Post Category Id:') !!}
    {!! Form::text('post_category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Post Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_id', 'Post Id:') !!}
    {!! Form::text('post_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {!! Form::submit('Save', ['class' => 'btn green']) !!}
            <a href="{!! route('admin.categoryPosts.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

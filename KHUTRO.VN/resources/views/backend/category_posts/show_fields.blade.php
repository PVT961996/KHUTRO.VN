<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $categoryPost->id !!}</p>
</div>

<!-- Post Category Id Field -->
<div class="form-group">
    {!! Form::label('post_category_id', 'Post Category Id:') !!}
    <p>{!! $categoryPost->post_category_id !!}</p>
</div>

<!-- Post Id Field -->
<div class="form-group">
    {!! Form::label('post_id', 'Post Id:') !!}
    <p>{!! $categoryPost->post_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $categoryPost->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $categoryPost->updated_at !!}</p>
</div>


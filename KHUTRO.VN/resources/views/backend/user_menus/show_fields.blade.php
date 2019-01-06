<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $userMenu->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $userMenu->user_id !!}</p>
</div>

<!-- Menu Id Field -->
<div class="form-group">
    {!! Form::label('menu_id', 'Menu Id:') !!}
    <p>{!! $userMenu->menu_id !!}</p>
</div>

<!-- Flag Field -->
<div class="form-group">
    {!! Form::label('flag', 'Flag:') !!}
    <p>{!! $userMenu->flag !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $userMenu->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $userMenu->updated_at !!}</p>
</div>


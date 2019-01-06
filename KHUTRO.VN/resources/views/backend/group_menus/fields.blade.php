<!-- Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group_id', 'Group Id:') !!}
    {!! Form::text('group_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Menu Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('menu_id', 'Menu Id:') !!}
    {!! Form::text('menu_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {!! Form::submit('Save', ['class' => 'btn green']) !!}
            <a href="{!! route('admin.groupMenus.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

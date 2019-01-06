<!-- Table Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('table_id', 'Table Id:') !!}
    <select name="table_id" class="form-control input-sm select2-multiple select2-hidden-accessible" tabindex="-1" aria-hidden="true">
        <?php foreach($tables as $key=>$table): ?>
        <option value="{{$table->id}}">{{$table->name}}</option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Action Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action_id', 'Action Id:') !!}
    <select name="action_id" class="form-control input-sm select2-multiple select2-hidden-accessible" tabindex="-1" aria-hidden="true">
        <?php foreach($actions as $key=>$action): ?>
        <option value="{{$action->id}}">{{$action->name}}</option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {!! Form::submit('Save', ['class' => 'btn green']) !!}
            <a href="{!! route('admin.menus.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

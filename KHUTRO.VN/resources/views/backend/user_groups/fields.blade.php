<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {{--{!! Form::text('user_id', null, ['class' => 'form-control']) !!}--}}
    <select id="user_select_box" name="user_id" class="form-control input-sm select2-multiple select2-hidden-accessible" tabindex="-1" aria-hidden="true">
        <?php foreach($users as $key=>$user): ?>
            <option value="{{$user->id}}">{{$user->name}}</option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group_id', 'Group Id:') !!}
    {{--{!! Form::text('group_id', null, ['class' => 'form-control']) !!}--}}
        <select name="group_id" class="form-control input-sm select2-multiple select2-hidden-accessible" tabindex="-1" aria-hidden="true">
            <?php foreach($groups as $key=>$group): ?>
                <option value="{{$group->id}}">{{$group->name}}</option>
            <?php endforeach; ?>
        </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {!! Form::submit('Save', ['class' => 'btn green']) !!}
            <a href="{!! route('admin.userGroups.index') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

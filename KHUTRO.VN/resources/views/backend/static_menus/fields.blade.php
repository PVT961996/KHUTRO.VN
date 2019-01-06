<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <div class="col-sm-6">
        {!! Form::label('parent_id', 'Parent:') !!}
        <select name="parent_id" class="bs-select form-control">
            @foreach($staticMenus as $id => $name)
                @if(isset($parent_id) && $parent_id == $id)
                    <option value="{{$id}}" selected>{{$name}}</option>
                @else
                    <option value="{{$id}}">{{$name}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'SAVE'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> Save & Edit', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'SAVE_EDIT'] )  }}
            {{ Form::button('<i class="fa fa-save"></i>  Save & New', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'SAVE_NEW'] )  }}
            <a href="{!! route('admin.staticMenus.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
        </div>
    </div>
</div>

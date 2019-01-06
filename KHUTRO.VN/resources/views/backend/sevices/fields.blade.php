<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', Lang::get('messages.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', Lang::get('messages.description')) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', Lang::get('messages.sevice_order')) !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', Lang::get('messages.icon')) !!}
    {!! Form::text('icon', null, ['class' => 'form-control']) !!}
</div>

<!-- Class Css Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_css', Lang::get('messages.class_css')) !!}
    {!! Form::text('class_css', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', Lang::get('messages.price')) !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                @if(isset($sevice))
                    <img style="" src="{!! $sevice->image !!}">
                @else
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                @endif
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
            <div>
        <span class="btn default btn-file">
            <span class="fileinput-new"> @lang('messages.select_image') </span>
            <span class="fileinput-exists"> @lang('messages.change') </span>
            {!! Form::file('image',[]) !!}
        </span>
                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
            </div>
        </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_edit'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_new'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new'] )  }}
            <a href="{!! route('admin.sevices.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
        </div>
    </div>
</div>

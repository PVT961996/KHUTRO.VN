<!-- Name Field -->
<div class="form_district col-sm-6">
    {!! Form::label('name', Lang::get('messages.name_district')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Province Id Field -->
<div class="form_district col-sm-6">
    {!! Form::label('province_id', Lang::get('messages.province_id')) !!}
    {!! Form::select('province_id', $provinces , null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form_district col-sm-6">
    {!! Form::label('description', Lang::get('messages.description')) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Slug Field -->
<div class="form_district col-sm-6">
    {!! Form::label('slug', Lang::get('messages.slug')) !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save_edit"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save_new"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new'] )  }}
            <a href="{!! route('admin.districts.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang("messages.back")</a>
        </div>
    </div>
</div>

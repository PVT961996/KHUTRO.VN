@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">@lang("messages.province_title")</span>
        </div>
        <div class="actions">
            <div class="row  col-md-offset-0">
                {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save', 'form'=>'form_province'] )  }}
                {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save_edit"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit', 'form'=>'form_province'] )  }}
                {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save_new"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new', 'form'=>'form_province'] )  }}
                <a href="{!! route('admin.provinces.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang("messages.back")</a>
            </div>
        </div>
    </div>
    <div>
        @include('metronic-templates::common.errors')
    </div>
    <div class="portlet-body form">
        <div class="row">
            @if (isset($type) && $type == 'DUPLICATE')
                {!! Form::model($province, ['id' => 'update_form_province', 'route' => ['admin.provinces.store']]) !!}
            @else
                {!! Form::model($province, ['id' => 'update_form_province', 'route' => ['admin.provinces.update', $province->id], 'method' => 'patch']) !!}
            @endif
            {!! csrf_field() !!}
            @include('backend.provinces.fields')
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
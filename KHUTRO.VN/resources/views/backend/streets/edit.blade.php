@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-blue-sunglo"></i>
                <span class="caption-subject font-blue-sunglo bold uppercase">@lang("messages.street_title")</span>
            </div>
            <div class="actions">
                <div class="row  col-md-offset-0">
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save', 'form'=>'form_street'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save_edit"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit', 'form'=>'form_street'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save_new"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new', 'form'=>'form_street'] )  }}
                    <a href="{!! route('admin.streets.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang("messages.back")</a>
                </div>
            </div>
        </div>
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row">
                @if (isset($type) && $type == 'DUPLICATE')
                    {!! Form::model($street, ['id' => 'update_form_street', 'route' => ['admin.streets.store']]) !!}
                @else
                    {!! Form::model($street, ['id' => 'update_form_street', 'route' => ['admin.streets.update', $street->id], 'method' => 'patch']) !!}
                @endif
                {!! csrf_field() !!}
                @include('backend.streets.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">@lang("messages.feedback_motel_types_edit")</span>
            </div>
            <div class="actions">
                <div class="row  col-md-offset-0">
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save', 'form'=>'update_form_feedback_motel_types'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save_edit"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit', 'form'=>'update_form_feedback_motel_types'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get("messages.save_new"), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new', 'form'=>'update_form_feedback_motel_types'] )  }}
                    <a href="{!! route('admin.feedbackMotelTypes.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang("messages.back")</a>
                </div>
            </div>
        </div>
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row">
                @if (isset($type) && $type == 'DUPLICATE')
                    {!! Form::model($feedbackMotelType, ['id' => 'update_form_feedback_motel_types', 'route' => ['admin.feedbackMotelTypes.store']]) !!}
                @else
                    {!! Form::model($feedbackMotelType, ['id' => 'update_form_feedback_motel_types', 'route' => ['admin.feedbackMotelTypes.update', $feedbackMotelType->id], 'method' => 'patch']) !!}
                @endif
                {!! csrf_field() !!}
                @include('backend.feedback_motel_types.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Action</span>
        </div>
        <div class="form-actions">
            <div class="row  pull-right">
                {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'action_update_form'] )  }}
                {{ Form::button('<i class="fa fa-save"></i> Save & Edit', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'action_update_form'] )  }}
                {{ Form::button('<i class="fa fa-save"></i>  Save & New', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'action_update_form'] )  }}
                <a href="{!! route('admin.actions.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
            </div>
        </div>
    </div>
    <div>
        @include('metronic-templates::common.errors')
    </div>
    <div class="portlet-body form">
        <div class="row">
            @if (isset($type) && $type == 'DUPLICATE')
                {!! Form::model($action, ['id' => 'action_update_form', 'route' => ['admin.actions.store']]) !!}
            @else
                {!! Form::model($action, ['id' => 'action_update_form', 'route' => ['admin.actions.update', $action->id], 'method' => 'patch']) !!}
            @endif
            {!! csrf_field() !!}
            @include('backend.actions.fields')

           {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
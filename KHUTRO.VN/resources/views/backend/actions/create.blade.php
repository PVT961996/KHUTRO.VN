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
                    {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'action_create_form'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i> Save & Edit', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'action_create_form'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i>  Save & New', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'action_create_form'] )  }}
                    <a href="{!! route('admin.actions.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
                </div>
            </div>
        </div>
        @include('flash::message')
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row">
                {!! Form::open(['id' => 'action_create_form', 'route' => 'admin.actions.store']) !!}

                    @include('backend.actions.fields')

                 {!! Form::close() !!}
            </div>
        </div>
  </div>
@endsection

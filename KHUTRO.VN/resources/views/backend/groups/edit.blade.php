@extends('layouts.app')

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-th font-blue-steel" aria-hidden="true"></i>
            <span class="caption-subject font-blue-steel bold uppercase">Groups</span>
        </div>
        <div class="actions">
            <div class="row  col-md-offset-0">
                {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save', 'form'=>'form_group'] )  }}
                {{ Form::button('<i class="fa fa-save"></i> Save & Edit', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit', 'form'=>'form_group'] )  }}
                {{ Form::button('<i class="fa fa-save"></i>  Save & New', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new', 'form'=>'form_group'] )  }}
                <a href="{!! route('admin.groups.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
            </div>
        </div>
    </div>
    <div>
        @include('metronic-templates::common.errors')
    </div>
    <div class="portlet-body form">
        <div class="row">
            @if (isset($type) && $type == 'DUPLICATE')
                {!! Form::model($group, ['id' => 'update_form_group', 'route' => ['admin.groups.store']]) !!}
            @else
                {!! Form::model($group, ['id' => 'update_form_group', 'route' => ['admin.groups.update', $group->id], 'method' => 'patch']) !!}
            @endif
            {!! csrf_field() !!}
            @include('backend.groups.fields')
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
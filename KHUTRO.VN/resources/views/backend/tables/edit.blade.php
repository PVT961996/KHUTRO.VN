@extends('layouts.app')

@section('content')
    <div class="portlet light bordered col-lg-9">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">Table</span>
            </div>
            <div class="form-actions">
                <div class="row  pull-right">
                    {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'table_update_form'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i> Save & Edit', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'table_update_form'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i>  Save & New', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'table_update_form'] )  }}
                    <a href="{!! route('admin.tables.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
                </div>
            </div>
        </div>
        @include('flash::message')
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row">
                @if (isset($type) && $type == 'DUPLICATE')
                    {!! Form::model($table, ['id' => 'table_update_form', 'route' => ['admin.tables.store']]) !!}
                @else
                    {!! Form::model($table, ['id' => 'table_update_form', 'route' => ['admin.tables.update', $table->id], 'method' => 'patch']) !!}
                @endif
                    {!! csrf_field() !!}
                    @include('backend.tables.fields')
               {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <label>
                        <input type="checkbox" class="icheck check-all">
                        <span class="caption-subject font-red-sunglo bold uppercase">Actions ({{$actions->count()}})</span>
                    </label>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="input-group">
                    <div class="icheck-list">
                        @foreach($actions as $action)
                            @if($current_action_ids->contains($action->id))
                                <label><input type="checkbox" name="action_ids[]" value="{{ $action->id }}" form="table_update_form" class="icheck check-single" checked> {{$action->name}} </label>
                            @else
                                <label><input type="checkbox" name="action_ids[]" value="{{ $action->id }}" form="table_update_form" class="icheck check-single"> {{$action->name}} </label>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
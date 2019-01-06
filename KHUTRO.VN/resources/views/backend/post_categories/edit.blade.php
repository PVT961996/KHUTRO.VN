@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.post_category')</span>
            </div>
            <div class="form-actions">
                <div class="row  pull-right">
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'postCategory_update_form'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_edit'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'postCategory_update_form'] )  }}
                    {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_new'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'postCategory_update_form'] )  }}
                    <a href="{!! route('admin.postCategories.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang("messages.back")</a>
                </div>
            </div>
        </div>
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row">
                @if (isset($type) && $type == 'DUPLICATE')
                    {!! Form::model($postCategory, ['id' => 'postCategory_update_form', 'route' => ['admin.postCategories.store']]) !!}
                @else
                    {!! Form::model($postCategory, ['id' => 'postCategory_update_form', 'route' => ['admin.postCategories.update', $postCategory->id], 'method' => 'patch']) !!}
                @endif
                {!! csrf_field() !!}
                @include('backend.post_categories.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.add_post')</span>
                    </div>
                    <div class="form-actions">
                        <div class="row  pull-right">
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'form_post_create'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_edit'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'form_post_create'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_new'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'form_post_create'] )  }}
                            <a href="{!! route('admin.tags.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang('messages.back')</a>
                        </div>
                    </div>
                </div>
                @include('flash::message')
                <div>
                    @include('metronic-templates::common.errors')
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        {!! Form::open(['route' => 'admin.posts.store','id'=>'form_post_create','enctype'=>'multipart/form-data']) !!}
                        @include('backend.posts.fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <label>
                            <input type="checkbox" class="icheck check-all">
                            <span class="caption-subject font-red-sunglo bold ">@lang('messages.category') ({{count($postCategories)}})</span>
                        </label>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="input-group">
                        <div class="icheck-list">
                            @foreach($postCategories as $category)
                                <label><input type="checkbox" name="category_ids[]" value="{{ $category->id }}" form="form_post_create" class="icheck check-single"> {{$category->name}} </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <label>
                            <input type="checkbox" class="icheck check-all-tag">
                            <span class="caption-subject font-red-sunglo bold ">Tags ({{count($tags)}})</span>
                        </label>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="input-group">
                        <div class="icheck-list">
                            @foreach($tags as $tag)
                                <label><input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" form="form_post_create" class="icheck check-single-tag"> {{$tag->name}} </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

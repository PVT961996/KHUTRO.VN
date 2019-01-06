@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.post')</span>
                    </div>
                    <div class="form-actions">
                        <div class="row  pull-right">
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'form_post'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_edit'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'form_post'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_new'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'form_post'] )  }}
                            <a href="{!! route('admin.posts.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> @lang('messages.back')</a>
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
                            {!! Form::model($post, ['id' => 'form_post','enctype'=>'multipart/form-data', 'route' => ['admin.posts.store']]) !!}
                        @else
                            {!! Form::model($post, ['id' => 'form_post','enctype'=>'multipart/form-data', 'route' => ['admin.posts.update', $post->id], 'method' => 'patch']) !!}
                        @endif
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
                            <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.category') ({{count($categories )}})</span>
                        </label>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="input-group">
                        <div class="icheck-list">
                            @foreach($categories as $category)
                                @if(inArrObj($category->id,$current_category_ids))
                                    <label><input type="checkbox" name="category_ids[]" value="{{ $category->id }}" form="form_post" class="icheck check-single" checked> {{$category->name}} </label>
                                @else
                                    <label><input type="checkbox" name="category_ids[]" value="{{ $category->id }}" form="form_post" class="icheck check-single"> {{$category->name}} </label>
                                @endif
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
                            <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.tag') ({{count($tags )}})</span>
                        </label>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="input-group">
                        <div class="icheck-list">
                            @foreach($tags as $tag)
                                @if(inArrObj($tag->id,$current_tag_ids))
                                    <label><input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" form="form_post" class="icheck check-single-tag" checked> {{$tag->name}} </label>
                                @else
                                    <label><input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" form="form_post" class="icheck check-single-tag"> {{$tag->name}} </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Tag</span>
                    </div>
                    <div class="form-actions">
                        <div class="row  pull-right">
                            {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save','form'=>'form_tag'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i> Save & Edit', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit','form'=>'form_tag'] )  }}
                            {{ Form::button('<i class="fa fa-save"></i>  Save & New', ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new','form'=>'form_tag'] )  }}
                            <a href="{!! route('admin.tags.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
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
                            {!! Form::model($tag, ['id' => 'form_tag', 'route' => ['admin.tags.store']]) !!}
                        @else
                            {!! Form::model($tag, ['id' => 'form_tag', 'route' => ['admin.tags.update', $tag->id], 'method' => 'patch']) !!}
                        @endif
                        @include('backend.tags.fields')

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
                            <span class="caption-subject font-red-sunglo bold uppercase">Posts ({{count($posts)}})</span>
                        </label>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="input-group">
                        <div class="icheck-list">
                            @foreach($posts as $post)
                                {{--{{dd(inArrObj($post->id,$current_post_ids))}}--}}
                                @if(inArrObj($post->id,$current_post_ids))
                                    <label><input type="checkbox" name="post_ids[]" value="{{ $post->id }}" form="form_tag" class="icheck check-single" checked> {{$post->title}} </label>
                                @else
                                    <label><input type="checkbox" name="post_ids[]" value="{{ $post->id }}" form="form_tag" class="icheck check-single"> {{$post->title}} </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
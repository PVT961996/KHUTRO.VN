@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">@lang('messages.post')</span>
            </div>
            <div class="actions">
                {!! Form::open(['id'=>'active','route' => ['admin.posts.active',$post->id],'method' => 'get']) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-default font-white green" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye "></i> @lang('messages.show_demo')</button>
                @if($post->status===0)
                    <button form="active"  class="btn btn-default font-white blue" name="submit_type" value="ACTIVE"><i class="fa fa-check "></i> @lang('messages.active')</button>
                @elseif($post->status===1)
                    <button form="active"  class="btn btn-default font-white yellow-lemon" name="submit_type" value="INACTIVE"><i class="fa fa-check "></i> @lang('messages.inactive')</button>
                @endif
                {{--<a href="{{route('admin.posts.active',$post->id)}}" class="btn btn-default font-white blue"  name="submit_type" value="ACTIVE">--}}
                {{--<i class="fa fa-edit"></i> Active </a>--}}
                <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-default font-white green">
                    <i class="fa fa-edit"></i> @lang('messages.edit') </a>
                <a href="{{route('admin.posts.create')}}" class="btn btn-default font-white blue-steel">
                    <i class="fa fa-plus"></i> @lang('messages.new') </a>
                <a href="{!! route('admin.posts.index') !!}" class="btn btn-default">
                    <i class="fa fa-reply "></i> @lang('messages.back') </a>
            </div>
        </div>
        <div>
            @include('metronic-templates::common.errors')
        </div>
        <div class="portlet-body form">
            <div class="row" style="padding-left: 15px; padding-right: 15px;">
                @include('backend.posts.show_fields')
                @if($post->status===0)
                    <button form="active"  class="btn btn-default font-white blue" name="submit_type" value="ACTIVE"><i class="fa fa-check "></i> @lang('messages.active')</button>
                @elseif($post->status===1)
                    <button form="active"  class="btn btn-default font-white yellow-lemon" name="submit_type" value="INACTIVE"><i class="fa fa-check "></i>@lang('messages.inactive')</button>
                @endif
                <a href="{!! route('admin.posts.edit',$post->id) !!}" class="btn btn-default btn-sm font-white green"><i class="fa fa-edit"></i> @lang('messages.edit')</a>
                <a href="{!! route('admin.posts.create') !!}" class="btn btn-default btn-sm font-white blue-steel"><i class="fa fa-plus"></i> @lang('messages.new') </a>
                <a href="{!! route('admin.posts.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply "></i> @lang('messages.back')</a>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><b>{{$post->title}}</b></h5>
                </div>
                <div class="modal-body">
                    -----------------
                    {{$post->content}}


                    <div class="col-lg-12" >
                        <h7 style="float: right"><a href={!! route('admin.users.show', [$post->user_id]) !!}>@lang('messages.auth'): {{$post->user->name}}</a></h7>
                    </div>

                    -----------------
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default blue" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', Lang::get('messages.title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            @if(isset($post))
                <img src="{!! $post->image_title !!}">
            @else
                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
            @endif
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
        <div>
                <span class="btn default btn-file">
                    <span class="fileinput-new"> @lang('messages.select_image_title') </span>
                    <span class="fileinput-exists"> @lang('messages.change') </span>
                    {!! Form::file('image_title',[]) !!}
                </span>
            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> @lang('messages.delete') </a>
        </div>
    </div>

</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('short_description', Lang::get('messages.short_description')) !!}
    {!! Form::textarea('short_description', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', Lang::get('messages.content')) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('seo_title', Lang::get('messages.seo_title')) !!}
    {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('seo_tag', Lang::get('messages.seo_tag')) !!}
    {!! Form::text('seo_tag', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('seo_description', Lang::get('messages.seo_description')) !!}
    {!! Form::text('seo_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="form-actions">
        <div class="row  col-md-offset-0">
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white blue-steel','name'=>'save','value'=>'save'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_edit'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green','name'=>'save','value'=>'save_edit'] )  }}
            {{ Form::button('<i class="fa fa-save"></i> '.Lang::get('messages.save_new'), ['type' => 'submit', 'class' => 'btn btn-default btn-sm font-white green-jungle','name'=>'save','value'=>'save_new'] )  }}
            <a href="{!! route('admin.posts.index') !!}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Back</a>
        </div>
    </div>
</div>

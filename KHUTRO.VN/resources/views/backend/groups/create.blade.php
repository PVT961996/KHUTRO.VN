@extends('layouts.app')

@section('content')
 <div class="portlet light bordered col-lg-12">
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
             {!! Form::open(['route' => 'admin.groups.store','id'=>'form_group']) !!}
             @include('backend.groups.fields')
             {!! Form::close() !!}
         </div>
     </div>
 </div>

 {{--<div class="col-lg-3">--}}
     {{--<div class="portlet light bordered">--}}
         {{--<div class="portlet-title">--}}
             {{--<div class="caption">--}}
                 {{--<label>--}}
                     {{--<input type="checkbox" class="icheck check-all">--}}
                     {{--<span class="caption-subject font-red-sunglo bold uppercase">Categories ({{$menus->count()}})</span>--}}
                 {{--</label>--}}
             {{--</div>--}}
         {{--</div>--}}
         {{--<div class="portlet-body form">--}}
             {{--<div class="input-group">--}}
                 {{--<div class="icheck-list">--}}
                     {{--@foreach($menus as $menu)--}}
                         {{--<label><input type="checkbox" name="menu_ids[]" value="{{ $menu->id }}" form="group_create_form" class="icheck check-single"> {{$menu->name}} </label>--}}
                     {{--@endforeach--}}
                 {{--</div>--}}
             {{--</div>--}}
         {{--</div>--}}
     {{--</div>--}}

     {{--<div class="portlet light bordered">--}}
         {{--<div class="portlet-title">--}}
             {{--<div class="caption">--}}
                 {{--<input type="checkbox" class="icheck check-all">--}}
                 {{--<span class="caption-subject font-green-sharp bold uppercase">Checkable Tree</span>--}}
             {{--</div>--}}
             {{--<div class="actions">--}}
                 {{--<div class="btn-group">--}}
                     {{--<a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions--}}
                         {{--<i class="fa fa-angle-down"></i>--}}
                     {{--</a>--}}
                     {{--<ul class="dropdown-menu pull-right">--}}
                         {{--<li>--}}
                             {{--<a href="javascript:;"> Option 1</a>--}}
                         {{--</li>--}}
                         {{--<li class="divider"> </li>--}}
                         {{--<li>--}}
                             {{--<a href="javascript:;">Option 2</a>--}}
                         {{--</li>--}}
                         {{--<li>--}}
                             {{--<a href="javascript:;">Option 3</a>--}}
                         {{--</li>--}}
                         {{--<li>--}}
                             {{--<a href="javascript:;">Option 4</a>--}}
                         {{--</li>--}}
                     {{--</ul>--}}
                 {{--</div>--}}
             {{--</div>--}}
         {{--</div>--}}
         {{--<div class="portlet-body">--}}
             {{--<div id="tree_2" class="tree-demo jstree jstree-2 jstree-default jstree-checkbox-selection" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j2_1" aria-busy="false"><ul class="jstree-container-ul jstree-children jstree-wholerow-ul jstree-no-dots" role="group"><li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="j2_1_anchor" aria-expanded="true" id="j2_1" class="jstree-node jstree-open"><div unselectable="on" role="presentation" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j2_1_anchor"><i class="jstree-icon jstree-checkbox jstree-undetermined" role="presentation"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i>Same but with checkboxes</a><ul role="group" class="jstree-children" style=""><li role="treeitem" aria-selected="true" aria-level="2" aria-labelledby="j2_2_anchor" id="j2_2" class="jstree-node  jstree-leaf"><div unselectable="on" role="presentation" class="jstree-wholerow jstree-wholerow-clicked">&nbsp;</div><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  jstree-clicked" href="#" tabindex="-1" id="j2_2_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i>initially selected</a></li><li role="treeitem" aria-selected="true" aria-level="2" aria-labelledby="j2_3_anchor" id="j2_3" class="jstree-node  jstree-leaf"><div unselectable="on" role="presentation" class="jstree-wholerow jstree-wholerow-clicked">&nbsp;</div><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  jstree-clicked" href="#" tabindex="-1" id="j2_3_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fa fa-warning icon-state-danger jstree-themeicon-custom" role="presentation"></i>custom icon</a></li><li role="treeitem" aria-selected="true" aria-level="2" aria-labelledby="j2_4_anchor" aria-expanded="true" id="j2_4" class="jstree-node  jstree-open"><div unselectable="on" role="presentation" class="jstree-wholerow jstree-wholerow-clicked">&nbsp;</div><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  jstree-clicked" href="#" tabindex="-1" id="j2_4_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-default jstree-themeicon-custom" role="presentation"></i>initially open</a><ul role="group" class="jstree-children"><li role="treeitem" aria-selected="true" aria-level="3" aria-labelledby="j2_5_anchor" id="j2_5" class="jstree-node  jstree-leaf jstree-last"><div unselectable="on" role="presentation" class="jstree-wholerow jstree-wholerow-clicked">&nbsp;</div><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  jstree-clicked" href="#" tabindex="-1" id="j2_5_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i>Another node</a></li></ul></li><li role="treeitem" aria-selected="true" aria-level="2" aria-labelledby="j2_6_anchor" id="j2_6" class="jstree-node  jstree-leaf"><div unselectable="on" role="presentation" class="jstree-wholerow jstree-wholerow-clicked">&nbsp;</div><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  jstree-clicked" href="#" tabindex="-1" id="j2_6_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fa fa-warning icon-state-warning jstree-themeicon-custom" role="presentation"></i>custom icon</a></li><li role="treeitem" aria-selected="false" aria-level="2" aria-labelledby="j2_7_anchor" aria-disabled="true" id="j2_7" class="jstree-node  jstree-leaf jstree-last"><div unselectable="on" role="presentation" class="jstree-wholerow">&nbsp;</div><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  jstree-disabled" href="#" tabindex="-1" id="j2_7_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fa fa-check icon-state-success jstree-themeicon-custom" role="presentation"></i>disabled node</a></li></ul></li><li role="treeitem" aria-selected="true" aria-level="1" aria-labelledby="j2_8_anchor" id="j2_8" class="jstree-node  jstree-leaf jstree-last"><div unselectable="on" role="presentation" class="jstree-wholerow jstree-wholerow-clicked">&nbsp;</div><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor jstree-clicked" href="#" tabindex="-1" id="j2_8_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i>And wholerow selection</a></li></ul></div>--}}
         {{--</div>--}}
     {{--</div>--}}
 {{--</div>--}}
@endsection

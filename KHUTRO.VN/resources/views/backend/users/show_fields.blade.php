<div class="profile">
    <div class="tabbable-line tabbable-full-width">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-unstyled profile-nav">
                    <li>
                        @if((!empty($user->avatar)) && file_exists(public_path($user->avatar)))
                            <img src="{!! $user->avatar !!}" class="img-responsive pic-bordered" alt="" style="
    padding-top: 10px;
"/>
                        @else
                            <img src="/uploads/default-avatar.png" alt="{!! $user->name !!}" width="250px"
                                 height="250px" style="
    padding-top: 10px;
">
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8 profile-info">
                        <h1 class="font-green sbold uppercase">{!! $user->name !!}</h1>
                        <p> {{$user->description}}
                        </p>
                        <ul class="list-inline">
                            <li>
                                <i class="fa fa-map-marker"></i> {{$user->address}} </li>
                            <li>
                                <i class="fa fa-calendar"></i> 18 Jan 1982
                            </li>
                            <li>
                                <i class="fa fa-briefcase"></i> {{$user->job}} </li>
                        </ul>
                    </div>
                    <!--end col-md-8-->
                    <div class="col-md-4">
                        <div class="portlet sale-summary">
                            <div class="portlet-title">
                                <div class="caption font-red sbold"> Sales Summary</div>
                                <div class="tools">
                                    <a class="reload" href="javascript:;"> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <ul class="list-unstyled">
                                    <li>
                                                                    <span class="sale-info"> TODAY SOLD
                                                                        <i class="fa fa-img-up"></i>
                                                                    </span>
                                        <span class="sale-num"> 23 </span>
                                    </li>
                                    <li>
                                                                    <span class="sale-info"> WEEKLY SALES
                                                                        <i class="fa fa-img-down"></i>
                                                                    </span>
                                        <span class="sale-num"> 87 </span>
                                    </li>
                                    <li>
                                        <span class="sale-info"> TOTAL SOLD </span>
                                        <span class="sale-num"> 2377 </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--end col-md-4-->
                </div>
            </div>
            <div class="col-md-12">
                <h2>Details</h2><!--end row-->
                <div class="tabbable-line tabbable-custom-profile">
                    <div class="portlet-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 150px" scope="row">{!! Form::label('name','Name') !!}</th>
                                <td><p>{!! $user->name !!}</p></td>
                            </tr>

                            <tr>
                                <th style="width: 150px" scope="row">{!! Form::label('groups','Groups') !!}</th>
                                <td><p>{!! toStringOf($user->groups,'name','show','admin.users.show') !!}</p></td>
                            </tr>

                            <tr>
                                <th style="width: 150px" scope="row">{!! Form::label('age','Age') !!}</th>
                                <td><p>{!! $user->age !!}</p></td>
                            </tr>
                            <tr>
                                <th style="width: 150px" scope="row">{!! Form::label('sex','Sex') !!}</th>
                                <td><p>{!! $user->sex !!}</p></td>
                            </tr>
                            <tr>
                                <th style="width: 150px" scope="row">{!! Form::label('email','Email') !!}</th>
                                <td><p>{!! $user->email !!}</p></td>
                            </tr>
                            <tr>
                                <th style="width: 150px" scope="row">{!! Form::label('phone_number','Phone') !!}</th>
                                <td><p>{!! $user->phone_number !!}</p></td>
                            </tr>
                            <tr>
                                <th style="width: 150px" scope="row">{!! Form::label('card_id','Card Id') !!}</th>
                                <td><p>{!! $user->card_id .' '. $user->issued_card !!}</p></td>
                            </tr>
                            <tr>
                                <th style="width: 150px" scope="row">{!! Form::label('created_at','Created At') !!}</th>
                                <td><p>{!! $user->created_at !!}</p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


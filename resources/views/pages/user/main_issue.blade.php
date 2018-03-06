<?php
/**
 * Created by PhpStorm.
 * User: feldy
 * Date: 01/10/2017
 * Time: 16:41
 */
?>
@extends('templates.default_main_page')

{{--Content--}}
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Issue</h1>
    </section>
    <!-- Main content -->
{{--    {{ dd(Request::) }}--}}
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                @if(SSGUtil::info('is_employee'))
                    <a href="{{ route('user.create_issue') }}" class="btn btn-primary btn-block margin-bottom">Create New Issue</a>
                @endif

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="{{ Input::get('status') == '' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['type' => Input::get('type')]) }}"><i class="fa fa-envelope-o"></i> All</a></li>
                            <li class="{{ Input::get('status') == 'OPEN' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => 'OPEN', 'type' => Input::get('type')]) }}"><i class="fa fa-inbox"></i> Open</a></li>
                            <li  class="{{ Input::get('status') == 'RESOLVED' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => 'RESOLVED', 'type' => Input::get('type')]) }}"><i class="fa fa-star-o"></i> Resolved</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Labels</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="{{ Input::get('type') == '' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => Input::get('status')]) }}"><i class="fa fa-circle-o text-gray"></i> All</a></li>
                            <li class="{{ Input::get('type') == 'ISSUE' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => Input::get('status'), 'type' => 'ISSUE']) }}"><i class="fa fa-circle-o text-red"></i> Issue Form</a></li>
                            <li class="{{ Input::get('type') == 'TRAINING' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => Input::get('status'), 'type' => 'TRAINING']) }}"><i class="fa fa-circle-o text-light-blue"></i> Training</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                @include("templates.default_alert_message")
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Issue List</h3>

                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <input class="form-control input-sm" placeholder="Search Issue" type="text">
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            <!-- /.btn-group -->
                            <a href="{{ url('issues') }}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                            <div class="pull-right">
                                {{ $items->currentPage().'-'.$items->perPage().'/'.$items->total() }}
                                <div class="btn-group">
                                    <a href="{{ $items->appends([])->previousPageUrl() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href="{{ $items->appends([])->nextPageUrl() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>

                                        <td style="width: 40px;">
                                            <span class="label label-danger pull-left">{{ $item->type }}</span> <br />
                                            <span class="label label-{{ $item->status == 'RESOLVED' ? 'primary' : 'warning' }} pull-left">{{ $item->status }}</span>
                                        </td>
                                        <td class="mailbox-name">#{{ $item->nomor_issue }}</td>
                                        <td class="mailbox-subject">[<strong>{{ $item->form_name }}</strong>] {{ $item->subject }}</td>
                                        <td style="width: 10px;" class="mailbox-attachment">
                                            {{--<i class="fa fa-paperclip"></i>--}}
                                        </td>
                                        <td style="width: 20px;" class="mailbox-date">{{ date_format($item->created_at, 'd/m/Y')}}</td>
                                        <td style="width: 20px;">
                                            <a href="{{ url("view-issue/?idHeader=".$item->id) }}" class="btn btn-default btn-sm">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
@endsection
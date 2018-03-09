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
                            <li class="{{ Input::get('status') == '' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['type' => Input::get('type'), 'search' => Input::get('search')]) }}"><i class="fa fa-envelope-o"></i> All</a></li>
                            <li class="{{ Input::get('status') == 'OPEN' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => 'OPEN', 'type' => Input::get('type'), 'search' => Input::get('search')]) }}"><i class="fa fa-folder-open text-blue"></i> Open</a></li>
                            <li  class="{{ Input::get('status') == 'RESOLVED' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => 'RESOLVED', 'type' => Input::get('type'), 'search' => Input::get('search')]) }}"><i class="fa fa-check text-green"></i> Resolved</a></li>
                            <li  class="{{ Input::get('status') == 'CLOSED' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => 'CLOSED', 'type' => Input::get('type'), 'search' => Input::get('search')]) }}"><i class="fa fa-close text-red"></i> Closed</a></li>
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
                            <li class="{{ Input::get('type') == '' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => Input::get('status'), 'search' => Input::get('search')]) }}"><i class="fa fa-circle-o text-gray"></i> All</a></li>
                            <li class="{{ Input::get('type') == 'ISSUE' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => Input::get('status'), 'type' => 'ISSUE', 'search' => Input::get('search')]) }}"><i class="fa fa-circle-o text-primary"></i> Issue Form</a></li>
                            <li class="{{ Input::get('type') == 'TRAINING' ? 'active' : '' }}"><a href="{{ url('issues/?') . http_build_query(['status' => Input::get('status'), 'type' => 'TRAINING', 'search' => Input::get('search')]) }}"><i class="fa fa-circle-o text-warning"></i> Training</a></li>
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
                            <form method="get" action="{{ url('issues/') }}">
                                <div class="input-group">
                                    <input type="hidden" name="type" value="{{ Input::get('type') ?? "" }}">
                                    <input type="hidden" name="status" value="{{ Input::get('status') ?? "" }}">
                                    <input type="text" value="{{ Input::get('search') ?? "" }}" name="search" placeholder="Search Issue" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info" type="submit">Search</button>
                                    </span>
                                </div>
                            </form>
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
                                    @if(empty(count($items)))
                                        <tr><td class="text-center" colspan="6">Tidak ada data</td></tr>
                                    @endif

                                    @foreach($items as $item)
                                    <tr>
                                        <td style="width: 40px;">
                                            <span class="label label-{{ $item->status == 'ISSUE' ? 'warning' : 'primary' }} pull-left">{{ $item->type }}</span> <br />
                                            <span class="label label-{{ (($item->status == 'RESOLVED') ? 'success' : (($item->status == 'CLOSED') ? 'danger' : 'info')) }} pull-left">{{ $item->status }}</span>
                                        </td>
                                        <td class="mailbox-name">#{{ $item->nomor_issue }}</td>
                                        <td class="mailbox-subject">[<strong>{{ $item->form_name }}</strong>] {{ $item->subject }}</td>
                                        <td style="width: 10px;" class="mailbox-attachment">
                                            @if($item->is_uploaded)
                                                <i class="fa fa-paperclip"></i>
                                            @endif
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
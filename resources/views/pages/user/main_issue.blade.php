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
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('user.create_issue') }}" class="btn btn-primary btn-block margin-bottom">Create New Issue</a>

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
                            <li class="active"><a href="#"><i class="fa fa-envelope-o"></i> All</a></li>
                            <li><a href="#"><i class="fa fa-inbox"></i> Open</a></li>
                            <li><a href="#"><i class="fa fa-star-o"></i> Resolved</a></li>
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
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Issue Form</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Training</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
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
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                            <div class="pull-right">
                                1-50/2
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
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
                                            <span class="label label-warning pull-left">{{ $item->status }}</span>
                                        </td>
                                        <td class="mailbox-name">#{{ $item->nomor_issue }}</td>
                                        <td class="mailbox-subject">[<strong>{{ $item->form_name }}</strong>] {{ $item->subject }}</td>
                                        <td class="mailbox-attachment">
                                            {{--<i class="fa fa-paperclip"></i>--}}
                                        </td>
                                        <td class="mailbox-date">{{ date_format($item->created_at, 'd/m/Y')}}</td>
                                        <td>
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
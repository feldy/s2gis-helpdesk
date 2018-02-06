<?php
/**
 * Created by PhpStorm.
 * User: feldy
 * Date: 01/10/2017
 * Time: 16:41
 */
?>
@extends('templates.default_main_page')
@section('css')
    <!-- Chosen -->
    <link href="{{ asset('assets/bootstrap/plugins/select2/select2.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/plugins/select2/select2-bootstrap.css') }} " rel="stylesheet">
@endsection
@section('js')
    <!-- Select2 -->
    <script src="{{ asset('assets/bootstrap/plugins/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/plugins/select2/i18n/id.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app/user/create_issue.js') }}" type="text/javascript"></script>
@endsection

{{--Content--}}
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create New Issue</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input class="form-control" id="subject" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <label for="cmb-form">Form</label>
                                <select class="form-control cmb-form"  id="cmb-form"></select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" rows="8" placeholder="Isi Keterangan"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input name="attachment" type="file">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <a href="{{ route("user.main_issue") }}" class="btn btn-primary"><i class="fa fa-save"></i> Save</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
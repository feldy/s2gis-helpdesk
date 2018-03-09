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
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" method="post" enctype="multipart/form-data"  action="{{ route('user.save_issue') }}">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create New Issue</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input class="form-control" name="subject" id="subject" required value="FORM TIDAK BISA DIBUKA" placeholder="Subject">
                            </div>
                            <div class="form-group{{ $errors->has('form_id') ? ' has-error' : '' }}">
                                <label for="cmb-form">Form</label>
                                <select name="form_id" class="form-control cmb-form"  id="cmb-form"></select>
                                @if ($errors->has('form_id'))
                                    <span class="help-block"><strong>Isian form tidak boleh kosong.</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" required rows="8" placeholder="Isi Keterangan">KETERANGAN FORM INI</textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file btn-attachment">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input multiple name="attachment[]" type="file" id="attachment" accept="image/*">
                                </div>
                            </div>
                            <div class="form-group">
                                <ul class="mailbox-attachments clearfix" id="file-preview"></ul>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
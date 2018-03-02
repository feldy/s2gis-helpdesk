<?php
/**
 * Created by PhpStorm.
 * User: feldy
 * Date: 01/10/2017
 * Time: 16:41
 */
?>
@extends('templates.default_main_page')
@section("css")
    <style type="text/css">
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 25px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        .btn-circle.btn-lg {
            width: 50px;
            height: 50px;
            padding: 9px;
            font-size: 30px;
            line-height: 0;
            border-radius: 25px;
        }

    </style>
@endsection
{{--Content--}}
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>
                <h3 class="box-title">Subject: [<strong>Form: {{ $item->form_name }}</strong>] {{ $item->subject }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-warning btn-block"><strong>{{ $item->status }}</strong></button>
                </div>
            </div>
            {{--{{ dd($item->details()->get()) }}--}}
            <div class="box-body chat" id="chat-box">
                @foreach($item->details()->get() as $detail)
                    <!-- chat item -->
                    <div class="item">
                        <img src="{{ asset('media/images/photo-profile/photo_profile.png') }}" class="online" alt="User Image">

                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ date_format($detail->created_at, 'd/m/y H:i:s') }}</small>
                                You
                            </a>
                            {{ $detail->keterangan }}
                        </p>
                    </div>
                    <!-- /.item -->
                @endforeach
            </div>
            <!-- /.chat -->
            <div class="box-footer">
                <div class="input-group">
                    <input class="form-control" placeholder="Type message...">

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-success"><i class="fa fa-send"></i> Kirim</button>
                        <button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Close Issue</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box (chat box) -->
    </section>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Sebelum issue di close, harap memberikan penilaian kepada kami !</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group text-center">
                        <div data-toggle="buttons">
                            <label class="btn btn-default btn-circle btn-lg">       <input type="radio" name="q1" value="0"><i class="fa fa-thumbs-o-down"></i></label>
                            <label class="btn btn-default btn-circle btn-lg active"><input type="radio" name="q1" value="1"><i class="fa fa-meh-o" checked></i></label>
                            <label class="btn btn-default btn-circle btn-lg">       <input type="radio" name="q1" value="4"><i class="fa fa-thumbs-o-up"></i></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-primary" href="{{ route("user.main_issue") }}">Save</a>
                </div>
            </div>
        </div>
    </div>
@endsection
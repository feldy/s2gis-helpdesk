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
                    <span class="badge badge"><strong>{{ $item->status }}</strong></span>
                </div>
            </div>
            {{--{{ dd($item->details()->get()) }}--}}
            <div class="box-body chat" id="chat-box">
                @foreach($item->details()->orderBy('created_at')->get() as $detail)
                    <!-- chat item -->
                    <div class="item">
                        <img src="{{ asset('media/images/photo-profile/photo_profile.png') }}" class="online" alt="User Image">

                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ date_format($detail->created_at, 'd/m/y H:i:s') }}</small>
                                @if(SSGUtil::info('username_id') == $detail->sender_id)
                                    You
                                @else
                                    {{ $detail->sender_name }}
                                @endif
                            </a>
                            {{ $detail->keterangan }}
                        </p>
                    </div>
                    <!-- /.item -->
                @endforeach
            </div>
            <!-- /.chat -->
            <div class="box-footer">
                <form role="form" method="post" enctype="multipart/form-data"  action="{{ route('user.update_issue') }}">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input name="id_hdr" type="hidden" value="{{ $item->id }}">
                        @if($item->status == 'OPEN')
                            <input name="keterangan" class="form-control" required placeholder="Type message...">
                            <div class="input-group-btn">
                                <button type="submit" name="btnsubmit" value="save" class="btn btn-success"><i class="fa fa-send"></i> Kirim</button>
                                @if(SSGUtil::info('is_employee'))
                                    <button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Close Issue</button>
                                @else
                                    <button type="submit" name="btnsubmit" value="resolved" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Resolved Issue</button>
                                @endif
                            </div>
                        @elseif($item->status == 'RESOLVED' && SSGUtil::info('is_employee'))
                            <button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Close Issue</button>
                        @elseif($item->status == 'CLOSED')
                            Ratting: <strong>{{ $item->ratting == -1 ? 'TIDAK PUAS' : $item->ratting == 0 ? 'CUKUP' : 'PUAS' }}</strong>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box (chat box) -->
    </section>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form role="form" method="post"  action="{{ route('user.update_issue') }}">
                {{ csrf_field() }}
                <input name="id_hdr" type="hidden" value="{{ $item->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Sebelum issue di close, harap memberikan penilaian kepada kami !</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group text-center">
                            <div data-toggle="buttons">
                                <label class="btn btn-default btn-circle btn-lg">
                                    <input onchange="onClickRatting(this.value)" type="radio" name="rdRatting" value="-1"><i class="fa fa-thumbs-o-down"></i>
                                </label>
                                <label class="btn btn-default btn-circle btn-lg active">
                                    <input onchange="onClickRatting(this.value)" type="radio" name="rdRatting" value="0"><i class="fa fa-meh-o" checked></i>
                                </label>
                                <label class="btn btn-default btn-circle btn-lg">
                                    <input onchange="onClickRatting(this.value)" type="radio" name="rdRatting" value="1"><i class="fa fa-thumbs-o-up"></i>
                                </label>
                            </div>
                            <h1><label id="lblRattingCaption">CUKUP</label></h1>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="btnsubmit" class="btn btn-primary" value="ratting">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script type="application/javascript">
        function onClickRatting(value) {
            console.log("value", value);
            var label = "CUKUP";
            switch(parseInt(value)) {
                case -1: label = "TIDAK PUAS"; break;
                case 0: label = "CUKUP";break;
                case 1: label = "PUAS";break;
            }
            $('#lblRattingCaption').html(label);
        }
    </script>
@endsection
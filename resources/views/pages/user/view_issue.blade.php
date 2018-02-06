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
    <!-- Main content -->
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>
                <h3 class="box-title">Subject: Form XXX Tidak bisa dibuka</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-warning btn-block"><strong>OPEN</strong></button>
                </div>
            </div>
            <div class="box-body chat" id="chat-box">
            @for($i=0;$i<5;$i++)
                <!-- chat item -->
                <div class="item">
                    <img src="{{ asset('media/images/photo-profile/photo_profile.png') }}" class="online" alt="User Image">

                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                            You
                        </a>
                        I would like to meet you to discuss the latest news about
                        the arrival of the new theme. They say it is going to be one the
                        best themes on the market
                    </p>
                </div>
                <!-- /.item -->
                <!-- chat item -->
                <div class="item">
                    <img src="{{ asset('media/images/photo-profile/photo_profile.png') }}" class="offline" alt="User Image">

                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                            Programmer 1
                        </a>
                        It is a long established fact that a reader will be distracted by the readable content of a page when
                        looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                        distribution of letters, as opposed to using 'Content here, content here', making it look like
                        readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as
                        their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.
                        Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                    </p>
                </div>
                <!-- /.item -->
                <!-- chat item -->
                <div class="item">
                    <img src="{{ asset('media/images/photo-profile/photo_profile.png') }}" class="online" alt="User Image">

                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                            You
                        </a>
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in
                        some form, by injected humour, or randomised words which don't look even slightly believable.
                        If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                        embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet
                        tend to repeat predefined chunks as necessary, making this the first true generator on the
                        Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence
                        structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore
                        always free from repetition, injected humour, or non-characteristic words etc
                    </p>
                </div>
                <!-- /.item -->
                @endfor
            </div>
            <!-- /.chat -->
            <div class="box-footer">
                <div class="input-group">
                    <input class="form-control" placeholder="Type message...">

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-success"><i class="fa fa-send"></i> Kirim</button>
                        <button type="button" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Close Issue</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box (chat box) -->
    </section>
    <!-- /.content -->
@endsection
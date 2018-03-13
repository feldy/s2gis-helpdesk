<?php
/**
 * Created by PhpStorm.
 * User: feldy
 * Date: 01/10/2017
 * Time: 02:22
 */
?>
@extends('templates.default_main_page')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>SELAMAT DATANG</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @if(SSGUtil::info('is_employee'))
        <div class="callout callout-info">
            <h4>Halooo User !</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
        </div>
        @else
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $count_issue }}</h3>
                            <p>Issue</p>
                        </div>
                        <div class="icon"><i class="fa fa-question"></i></div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $count_resolved }}</h3>
                            <p>Resolved</p>
                        </div>
                        <div class="icon"><i class="fa fa-check-square-o"></i></div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $count_puas }}</h3>
                            <p>Puas</p>
                        </div>
                        <div class="icon"><i class="fa fa-thumbs-o-up"></i></div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $count_tidak_puas }}</h3>
                            <p>Tidak Puas</p>
                        </div>
                        <div class="icon"><i class="fa fa-thumbs-o-down"></i></div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        @endif

    </section>
    <!-- /.content -->
@endsection

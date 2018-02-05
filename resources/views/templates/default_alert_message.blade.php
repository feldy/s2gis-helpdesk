<?php
/**
 * Created by PhpStorm.
 * User: feldy
 * Date: 22/11/2017
 * Time: 23:24
 */
?>
@if(Session::has('success'))
    <div class="alert alert-success">
        <strong>Success!</strong> {{ Session::get('success') }}
    </div>
@elseif(Session::has('info'))
    <div class="alert alert-info">
        <strong>Info!</strong> {{ Session::get('info') }}
    </div>
@elseif(Session::has('error'))
    <div class="alert alert-danger">
        <strong>Failed!</strong> {{ Session::get('error') }}
    </div>
@endif

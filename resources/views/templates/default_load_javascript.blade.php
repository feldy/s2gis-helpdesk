<?php
/**
 * Created by PhpStorm.
 * User: feldy
 * Date: 01/10/2017
 * Time: 01:29
 */
?>

<!-- jQuery 2.2.3 -->
<script src="{{ asset('assets/bootstrap/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<!-- jQuery UI -->
<script src="{{ asset('assets/bootstrap/plugins/jQueryUI/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/bootstrap/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset('assets/bootstrap/js/fastclick.js') }}" type="text/javascript"></script>
<!-- Admin App -->
<script src="{{ asset('assets/bootstrap/js/app.min.js') }}" type="text/javascript"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('assets/bootstrap/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/bootstrap/plugins/moment/moment.min.js') }}"></script>
<script type="application/javascript">
    //parsing URL LARAVEL
     parsingURL = function (URI) {
        var value = "";
        if (URI) {
            value = '{{ url("") }}';
            value += "/" + URI;
        }
        return value;
    }

    //parsing ASSET LARAVEL
    getURLAsset = function () {
        return '{{ asset("") }}';
    }

    //getAkses
    $.get('/login?from_url=/', {})
        .done(function() {console.log('Granted!!')})
        .fail(function() {
            window.location='/login?from_url=/';
        })
</script>
<script src="{{ asset('app/startup/main.js') }}" type="text/javascript"></script>

@yield('js')
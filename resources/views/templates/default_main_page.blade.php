<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include("templates.default_head")
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            @include("templates.default_navigation")
            @include("templates.default_footer")
        </div><!-- ./wrapper -->
        @include("templates.default_load_javascript")
        @include("templates.default_modal_image_preview")
    </body>
</html>
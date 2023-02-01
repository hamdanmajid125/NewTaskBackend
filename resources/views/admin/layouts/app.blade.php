<!-- https://riday-admin-template.multipurposethemes.com/bs4/main/index.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset($favicon) }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('admin/css/vendors_css.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/skin_color.css') }}">
    @include('admin.layouts.assets.css')
    @stack('css')
</head>

<body class="hold-transition light-skin sidebar-mini theme-danger fixed">
    <div class="wrapper">
        <div id="loader"></div>
        @include('admin.layouts.components.header')
        @include('admin.layouts.components.sidebar')
        <div class="content-wrapper">
            <div class="container-full">
                @yield('content')
            </div>
        </div>
        @include('admin.layouts.components.right-bar')
        @include('admin.layouts.components.footer')
        <div class="control-sidebar-bg"></div>
    </div>
    @include('admin.layouts.assets.scripts')
    @stack('js')
</body>

</html>

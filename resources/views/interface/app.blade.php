<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('include.style')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        @include('include.navbar')

        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('include.footer')
    </div>
    @include('include.script')
</body>

</html>

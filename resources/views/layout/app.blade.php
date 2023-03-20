<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=chrome">
    {{-- <link rel="shortcut icon" href="/favicon.ico"> --}}
    <title>@yield('title', '神织知更的博客') - 神织知更的博客</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layout.style')
</head>

<body>
    <!-- 头部 -->
    @include('layout.header')
    <div class="container body-container container-fluid">
        @yield('content')
    </div>
    <!-- 底部 -->
    @include('layout.footer')
    @include('layout.script')
</body>

</html>

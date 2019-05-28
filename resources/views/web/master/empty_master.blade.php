<!DOCTYPE HTML>
<html lang="zh">
    <head>
        <meta charset="utf-8" />
        <title>@yield('page_title', 'Nebula fund')</title>
        <meta name="keywords" content="" />
        <link rel="shortcut icon" href="{{ asset('/image/logo/nebula_logo_simple_favicon.png') }}" />
        <link rel="bookmark" href="" type="image/x-icon" />

        <link rel="stylesheet" href="{{ asset('/css/global.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
        <style type="text/css">
        </style>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="app"></div>
        <script src="{{ asset('/js/app.js') }}"></script>
        <script>
            Vue.config.errorHandler = function (err, vm, info) {
                // handle error
                console.error(vm.$el);
                console.error(err);
            };
        </script>

        @if(count($errors) > 0)
            <script>$.errorTip('{{ implode(';', $errors->all()) }}')</script>
        @endif

        <div class="container-row">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </body>
</html>

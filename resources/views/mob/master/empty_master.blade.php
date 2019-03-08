<!DOCTYPE HTML>
<html lang="zh">
    <head>
        <title>恋爱计时</title>
        <meta name="keywords" content="" />
        <meta name="description" content=""/>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="" />
        <link rel="bookmark" href="" type="image/x-icon" />
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />

        <link rel="stylesheet" href="{{ asset('/css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

        <style>
            body{
                margin: 0;
                padding: 0;
                background-color: white;
            }
        </style>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="app"></div>
        <script src="{{ asset('/js/app.js') }}"></script>

        @yield('content')
    </body>
</html>
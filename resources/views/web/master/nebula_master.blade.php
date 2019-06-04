<!DOCTYPE HTML>
<html lang="zh">
    <head>
        <meta charset="utf-8" />
        <title>@yield('page_title', 'Nebula fund')</title>
        <meta name="keywords" content="" />
        <link rel="shortcut icon" href="{{ asset('/image/logo/nebula_logo_simple_favicon.png') }}" />
        <link rel="bookmark" href="" type="image/x-icon" />

        <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/global.css') }}" />

        <style type="text/css">
            .navbar {
                box-shadow: 0 1px 4px 0 rgba(0,0,0,.08);
            }
            .navbar .navbar-brand {
                margin-right: 50px;
            }
            .navbar .navbar-brand img {
                height:32px;
            }
            #signout:hover {
                color: red;
                cursor: pointer;
            }
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

        <nav id="navbar_panel" class="navbar navbar-expand-md navbar-light" style="background-color: #FFF">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/" style="color: #A020F0;">
                        <img src="{{ url('/image/logo/nebula_logo_full_black.png') }}" />星云财富
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" id="navbar_home"><a class="nav-link" href="{{ url('/') }}">首页</a></li>
                        {{--<li class="nav-item dropdown" id="navbar_report">--}}
                            {{--<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">举报处理 </a>--}}
                            {{--<div class="dropdown-menu">--}}
                                {{--<a class="nav-link" href="{{ url('/admin/contact/report/feedessaylist') }}">举报短文</a>--}}
                                {{--<a class="nav-link" href="{{ url('/admin/contact/report/feedcomicslist') }}">举报条漫</a>--}}
                                {{--<a class="nav-link" href="{{ url('/admin/contact/report/feedshredlist') }}">举报碎饼</a>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        {{--<li id="navbar_contact"><a class="nav-link" href="{{ url('/admin/contact/suggestion/lists') }}">意见反馈</a></li>--}}
                    </ul>

                    <ul class="nav">
                        <li><a id="signout" class="nav-link" v-on:click="signout">退出</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        @if(count($errors) > 0)
            <script>$.errorTip('{{ implode(';', $errors->all()) }}')</script>
        @endif

        <div class="container-row">
            <div class="container">
                @yield('content')
            </div>
        </div>

        <script type="text/javascript">
            let navbarObj = new Vue({
                el: '#navbar_panel',
                data: {
                },
                methods: {
                    signout: function() {
                        axios.post('/user/account/signout_ajax').then(function(response) {
                            window.location.reload();
                        });
                    }
                }
            })
        </script>
    </body>
</html>

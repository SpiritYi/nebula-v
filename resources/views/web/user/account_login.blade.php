@extends('web.master.empty_master')

@section('content-full')
    <style type="text/css">
        .login-content {
            margin-bottom: 80px;
        }

        .logo-card {
            margin-top: 100px;
            text-align: center;
        }
        .logo-card img {
            width: 350px;
        }

        .login-card {
            margin-top: 100px;
            padding: 30px 15px;
        }
        .login-card .title {
            margin-bottom: 30px;
            font-size: 18px;
            font-weight: 400;
            color: #A020F0;
        }
        .login-card .pwd-bar {
            margin-bottom: 20px;
        }
        .login-card .btn {
            width: 100%;
            color: #A020F0;
        }
    </style>

    <div class="container">
        <div id="login_panel" class="row justify-content-md-center login-content">
            <div class="col-md-7 logo-card">
                <img src="{{ asset('/image/logo/nebula_logo_full_black.png') }}" />
            </div>
            <div class="col-md-3 block-card login-card">
                <div class="title">星云财富</div>
                <div class="form-group pwd-bar">
                    <input type="password" class="form-control nebula-input-control" v-model="identity">
                </div>
                <button type="button" class="btn btn-light" v-on:click="userLogin">登录</button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let vueobj = new Vue({
            el: '#login_panel',
            data: {
                reurl: '{{ $reurl }}',

                identity: '',
            },
            mounted: function() {
            },
            methods: {
                userLogin: function() {
                    let vueThis = this;
                    let param = {
                        reurl: this.reurl,
                        identity: this.identity,
                    };
                    axios.post('/user/account/login_ajax', param).then(function(response) {
                        window.location = vueThis.reurl;
                    }).catch(function(error) {
                        $.errorTip(error.response.data.em);
                    });
                }
            }
        });
    </script>
@endsection
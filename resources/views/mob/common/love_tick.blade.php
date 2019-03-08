@extends('mob.master.empty_master')

@section('content')
    <style type="text/css">
        .love-item {
            padding: 20px 20px 10px 20px;
            background-color: #F5F5F5;
        }
        .love-item .big-word {
            color: #FF33FF;
        }
        .love-item .top-text {
            margin-bottom: 10px;
        }
        .big-word {
            font-size: 300%;
            color: #CCC;
            width: 80px;
            margin-right: 10px;
        }
        .gap-text {
            margin-right: 15px;
        }
    </style>

    <div id="tick_panel">
        <div class="love-item">
            <div class="top-text">
                <span class="color-gray">相识 2015/10/20</span>
            </div>
            <div class="time-line">
                <span class="big-word">{{ $love_time['a'] }}</span><span class="gap-text">天</span>
            </div>
            <div class="time-line">
                <span class="big-word">{{ intval($love_time['y']) }}</span><span class="gap-text">年</span>
                <span class="big-word">{{ $love_time['m'] }}</span><span class="gap-text">月</span>
                <span class="big-word">{{ $love_time['d'] }}</span><span class="gap-text">日</span>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let vueObj = new Vue({
            el: '#tick_panel',
            data: {

            },
            mounted: function() {
            },
            methods: {
            }
        });
    </script>
@endsection
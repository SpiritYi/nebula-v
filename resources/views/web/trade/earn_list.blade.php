@extends('web.master.nebula_master')

@section('content')
    <style type="text/css">
        #charts_panel {
            margin: 50px 0;
        }
        .charts-block {
            margin-bottom: 50px;
        }
        .charts-block .tip-label {
            font-size: 11px;
            font-weight: normal;
        }
    </style>

    <div id="charts_panel" class="block-card">
        <div id="rate_panel" class="charts-block"></div>
        <div id="total_panel" class="charts-block"></div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        let vueObj = new Vue({
            el: '#charts_panel',
            data: {
            },
            mounted: function() {
                let vueThis = this;

                this.getRateChartsList();
                this.getTotalChartsList();
            },
            methods: {
                getRateChartsList: function() {
                    axios.get('/trade/earn/ratelist_ajax', {}).then(function(response) {
                        let chartsData = response.data.data;
                        //净值总收益额图表
                        Highcharts.chart('rate_panel', {
                            chart: {
                                type: 'column'
                            },
                            colors: ['#A020F0', '#000', '#3CF'],
                            plotOptions: {
                                column: {
                                    dataLabels: {
                                        enabled: true,
                                        formatter: function() {
                                            if (this.y < 0) {
                                                return '<span class="tip-label" style="color:#00FF00">' + this.y + '%</span>';
                                            } else {
                                                return '<span class="tip-label" style="color:red;">' + this.y + '%</span>';
                                            }
                                        }
                                    },
                                }
                            },
                            series: chartsData.rate_series,
                            title: {
                                text: '月度收益率'
                            },
                            tooltip: {
                                valueSuffix: '%'
                            },
                            xAxis: {
                                categories: chartsData.date_arr,
                            },
                            yAxis: {
                                title: {
                                    text: '收益率(%)'
                                }
                            },
                        });
                    }).catch(function() {

                    });
                },
                getTotalChartsList: function() {
                    axios.get('/trade/earn/totallist_ajax', {}).then(function(response) {
                        let chartsData = response.data.data;
                        //净值总收益额图表
                        Highcharts.chart('total_panel', {
                            chart: {
                                type: 'line'
                            },
                            colors: ['#A020F0', '#000', '#3CF'],
                            series: chartsData.total_series,
                            title: {
                                text: '累计收益'
                            },
                            tooltip: {
                                valueSuffix: ' 份'
                            },
                            xAxis: {
                                categories: chartsData.date_arr,
                            },
                            yAxis: {
                                title: {
                                    text: '所持份额 (份)'
                                }
                            },
                        });
                    }).catch(function() {

                    });
                }
            }
        });
    </script>
@endsection
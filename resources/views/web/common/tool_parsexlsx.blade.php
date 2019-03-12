@extends('web.master.empty_master')

@section('content')
    <style type="text/css">
        .action-bar {
            padding: 20px 0;
        }
        .action-bar button {
            width: 100px;
        }

        .input-bar {
            margin-bottom: 20px;
        }
    </style>

    <div id="parse_panel">
        <div class="action-bar">
            <input type="file" v-on:change="xlsxChange">
            <button type="button" class="btn btn-primary" v-on:click="uploadFile">解析</button>
        </div>
        <div class="input-bar">
            <textarea class="form-control" rows="10" v-model="dataJson" placeholder="格式化的极光数据"></textarea>
        </div>
        <div>
            <pre v-text="dataJsonFmt">

            </pre>
        </div>
    </div>

    <script type="text/javascript">
        let vueObj = new Vue({
            el: '#parse_panel',
            data: {
                xlsxFileObj: '',
                dataJson: '',
                dataJsonFmt: '',
            },
            methods: {
                xlsxChange: function(event) {
                    this.xlsxFileObj = event.target.files[0];
                },
                uploadFile: function() {
                    if (this.xlsxFileObj !== '') {
                        let xlsxFile = this.xlsxFileObj, vueThis = this;

                        let param = new FormData();
                        param.append('xlsx_file', xlsxFile, xlsxFile.name);
                        param.append('file_name', xlsxFile.name);
                        let config = {
                            headers:{'Content-Type':'multipart/form-data'}
                        };
                        axios.post('{{ url('/common/tool/uploadxlsx_ajax') }}', param, config).then(function(response) {
                            vueThis.dataJson = JSON.stringify(response.data.data);
                            vueThis.dataJsonFmt = JSON.stringify(response.data.data, undefined, 2);
                            console.log(response);
                        }).catch(function(error) {

                        });
                    }
                }
            }
        });
    </script>
@endsection
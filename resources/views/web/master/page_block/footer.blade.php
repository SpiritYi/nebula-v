@section('footer')
    <style type="text/css">
        .footer {
            margin-top: 20px;
            background-color: #F0F0F0;
        }
        .footer .copyright {
            margin: 20px 0;
            display: block;
            color: #E0E0E0;
            text-align: center;
        }
    </style>

    <div class="footer">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="copyright"> ©2014-{{ date('Y') }} 星云财富基金. ALL Rights Reserved.</div>
            </div>
        </div>
    </div>
@endsection
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LOGIN ADMIN</title>

   <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
   <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">
   <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
   <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

</head>
<body class="auth">

    <div class="container">

        @yield('content')

        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{('js/jquery.min.js')}}"></script>
    <script src="{{('js/bootstrap.min.js')}}"></script>
    <script src="{{('js/metisMenu.min.js')}}"></script>
    <script src="{{('js/sb-admin-2.js')}}"></script>

   
</body>
</html>

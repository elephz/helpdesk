<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>helpdesk</title>

    <!-- Custom fonts for this template-->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="{{ asset('theme/backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="{{ asset('theme/backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/frontend/assets/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" />

    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Kanit', sans-serif !important;
            letter-spacing: 2px;
            font-weight: bold;
        }
        .jumbotron{
            background-color: #D30000;
        }
        h1 i {
            font-size: 120px;
            font-weight: bold;
        }
    </style>
    @yield('head')

</head>

<body id="page-top">
    <div class="container-fluid text-white h-100">
        <div class="row">
            <div class="col text-center">
                <div class="jumbotron my-5">
                    <h1><i class="fas fa-ban"></i></h1>
                    <h1 class="display-4">ไม่สามารถเข้าสู่ระบบได้</h1>
                    <p class="lead">
                        กรุณาติดต่อผู้ดูและระบบ
                    </p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <button class="btn btn-primary" >Logout</button>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>
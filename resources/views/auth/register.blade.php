<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('theme/backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('theme/backend/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <style>
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            overflow: auto;
            width: 100%;
        }

        ul li {
            color: #AAAAAA;
            display: block;
            position: relative;
            float: left;
        }

        ul li input[type=radio] {
            position: absolute;
            visibility: hidden;
        }

        ul li label {
            display: block;
            position: relative;
            font-weight: 300;
            font-size: 18px;
            padding: 5px 21px 4px 33px;
            z-index: 9;
            cursor: pointer;
            -webkit-transition: all 0.25s linear;
        }

        ul li:hover label {
            color: #4e73df;
        }

        ul li .check {
            display: block;
            position: absolute;
            border: 5px solid #AAAAAA;
            border-radius: 100%;
            height: 25px;
            width: 25px;
            top: 5px;
            left: 0px;
            z-index: 5;
            transition: border .25s linear;
            -webkit-transition: border .25s linear;
        }

        ul li:hover .check {
            border: 5px solid #4e73df;
        }

        ul li .check::before {
            display: block;
            position: absolute;
            content: '';
            border-radius: 100%;
            height: 10px;
            width: 10px;
            top: 3px;
            left: 2.5px;
            margin: auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
        }

        input[type=radio]:checked~.check {
            border: 5px solid #0DFF92;
        }

        input[type=radio]:checked~.check::before {
            background: #0DFF92;
        }

        input[type=radio]:checked~label {
            color: #0DFF92;
        }

        .f-thai {
            font-family: 'Kanit', sans-serif !important;
            letter-spacing: 2px;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 f-thai">สร้างบัญชีผู้ใช้งาน</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="f-thai">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ชื่อ') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('นามสุกล') }}</label>

                                    <div class="col-md-6">
                                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror " name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname">

                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('อีเมล์') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่าน') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('ยืนยันรหัสผ่าน') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('ตำแหน่ง') }}</label>
                                    <div class="col-md-6">
                                        <ul>
                                            <li>
                                                <input type="radio" id="f-option" name="role" value="1" checked>
                                                <label for="f-option">ผู้ใช้งาน</label>
                                                <div class="check"></div>
                                            </li>
                                            <li>
                                                <input type="radio" id="s-option" name="role" value="2">
                                                <label for="s-option">ช่างเทคนิค</label>
                                                <div class="check"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('สมัคสมาชิก') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small f-thai" href="{{ route('login') }}">กลับสู่หน้าเข้าสู่ระบบ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('theme/backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('theme/backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('theme/backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/backend/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
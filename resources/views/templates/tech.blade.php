<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>@yield('title')</title>

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
    <link href="{{ asset('css/modalSix.css') }}" rel="stylesheet">

    <style>
        .f-thai {
            font-family: 'Kanit', sans-serif !important;
            letter-spacing: 2px;
            font-weight: bold;
        }
        .sidebar{
            transition: 0.4 ease-in-out;
        }
        #accordionSidebar .nav-item span{
            font-family: 'Kanit', sans-serif !important;
            letter-spacing: 2px;
            font-weight: bold;
        }
    </style>
    @yield('head')

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.tech.slidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.tech.topbar')

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Yanakorn 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('theme/backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('theme/backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/backend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('theme/backend/vendor/chart.js') }}/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('theme/backend/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('theme/backend/js/demo/chart-pie-demo.js') }}"></script>  -->

    <script src="{{ asset('theme/frontend/assets/sweetalerts/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('theme/backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $('#confirmBox').on('click', function(e) {
            e.preventDefault();
            swal({
                title: 'ออกจากระบบ',
                text: "ยืนยันการออกจากระบบ",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ปิด',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $('#logout-form').submit();
                }
            })
        })

        function Cttoas(type, message) {
            const toast = swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: type,
                title: message,
                padding: '2em',
            })
        }
    </script>
    @yield('script')
</body>

</html>
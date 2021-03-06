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
    <style>
        .f-thai {
            font-family: 'Kanit', sans-serif !important;
            letter-spacing: 2px;
            font-weight: bold;
        }
        .table-responsive{
            overflow-x: hidden;
        }
        .pagination{
            float: right;
        }
        #dataTable_filter{
            float: right;
        }
        table > thead {
            background-color: #2c3e50;
            color: white;
        }
        .modal-background .modal {
            position: relative;
        }
       
        .card-header{
            background-color: #1abc9c;
            color: white !important;
        }
        #accordionSidebar{
            transition: 0.4s;
        }
        #accordionSidebar .nav-item span{
            font-family: 'Kanit', sans-serif !important;
            letter-spacing: 2px;
            font-weight: bold;
        }
        @media only screen and (max-width: 600px) { 
            .table-responsive{
            overflow-x: auto;
        }
         }
    </style>
    @yield('head')

</head>

<body id="page-top">
@yield('modal')


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.admin.slidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.admin.topbar')

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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('theme/backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('theme/backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/backend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('theme/backend/vendor/chart.js') }}/Chart.min.js') }}"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('theme/backend/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('theme/backend/js/demo/chart-pie-demo.js') }}"></script> -->

    <script src="{{ asset('theme/frontend/assets/sweetalerts/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('theme/backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $('#confirmBox').on('click', function(e) {
            e.preventDefault();
            swal({
                title: '??????????????????????????????',
                text: "?????????????????????????????????????????????????????????",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '??????????????????',
                cancelButtonText: '?????????',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $('#logout-form').submit();
                }
            })
        })

        $(()=>{
            $("#modal-container .modal-background .modal .modal-header i").click(()=>{
                console.log("hey");
                $(".two").addClass('out');
                $('body').removeClass('modal-active');
            })
        })
    </script>
    @yield('script')
</body>

</html>
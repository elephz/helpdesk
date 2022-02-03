<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />


    <title>HELP DESK</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('theme/frontend/css/styles.css') }}" rel="stylesheet" />
    <!-- sweatalert -->
    <link href="{{ asset('theme/frontend/assets/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!-- Custom styles for this page -->
    <link href="{{ asset('theme/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/form.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        #portfolio {
            margin-top: 11rem !important;
        }
        .page-section{
            padding:0 !important;
        }


        le>img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        ul.list-unstyled li {
            table-layout: fixed;
            padding: 10px 5px;
            display: table;
            font-family: 'Kanit', sans-serif !important;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .info-list-title {
            min-width: 108px;
            display: table-cell;
            color: #ff5938;
        }

        table>thead>tr>th {
            text-align: center;
        }

        .list-group-item {
            display: grid;
            grid-template-columns: 100px 1fr 1fr;
            grid-gap: 10px;
            border: unset;
            border-radius: 15px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
            overflow-y: auto;
            overflow-x: hidden;
        }

        li .info-list-text {
            color: #888ea8;
        }

        .alist {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-gap: 10px;
        }

        .flist {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 10px;
        }

        .flist .list-group-item {
            height: 155px;
        }

        .tlist {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 10px;
        }

        h1 {
            font-size: 4.5rem;
        }

        .tlist .list-group-item {
            min-height: 175px;
        }

        .alist .list-group-item {
            grid-template-columns: 50px 1fr;
            align-items: center;
        }

        .alist .list-group-item h1 {
            font-size: 2.5rem;
        }

        .alist .list-group-item .info-list-text {
            font-size: 12px;
        }

        h1 i {
            color: #2c3e50;
        }

        .h500 {
            height: 500px;
        }


        ul.eq-list .list-item ul li {
            display: grid;
            grid-template-columns: 100px 1fr;
            grid-column-gap: 10px;
            align-items: center;
            justify-content: center;
            align-items: center;
            
        }

        .scrollbar {
            float: left;
            height: 420px;
            background: #F5F5F5;
            overflow-y: scroll;
            margin-bottom: 5px;
        }

        #style-4::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #style-4::-webkit-scrollbar {
            width: 5px;
            background-color: #F5F5F5;
        }

        #style-4::-webkit-scrollbar-thumb {
            background-color: #111;
            border: 1px solid #555555;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="{{route('user.dashboard')}}"><i class="fas fa-home"></i></a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger f-thai" id="confirmBox" href="">
                            <i class="fas fa-power-off"></i>
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <section class="page-section portfolio pt-5 py-2" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 f-thai">{{$job->JobId}}</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-cog fa-w-18"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->

        </div>
    </section>
    <section class="page-section  mb-0  mt-0" >
        <!-- About Section Content-->

        <div class="row mb-4 full-width">
            <div class="container" style="max-width: 1500px;">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="row mb-3">
                            <div style="height: 500px;" class="mx-auto">
                                <img src="{{$job->getImg()}}" alt="" class='mw-100 shadow rounded bg-white mh-100'>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8 col-12">
                        <ul class='list-group alist f-thai'>
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="fas fa-cog"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>ประเภทงาน</span>
                                    <span class='info-list-text'>{{$job->JobType->name}}</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="far fa-address-book"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>ชื่อ</span>
                                    <span class='info-list-text'>{{$job->getUser->name}}</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="fas fa-phone-square"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>โทรศัพท์</span>
                                    <span class='info-list-text'>{{$job->getUser->phone}}</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="far fa-bookmark"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>สถานะ</span>
                                    <span class='info-list-text badge badge-pill badge-primary {{$job->StatusColor()}} text-white py-2 px-3'>{{$job->JobStatus()}}</span>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-group alist my-4 f-thai">
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="far fa-clock"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>แจ้งเมื่อ</span><br>
                                    <span class='info-list-text'>{{$job->formattedDate($job->created_at)}}</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="far fa-clock"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>รับแจ้งเมื่อ</span><br>
                                    <span class='info-list-text'>{{$job->formattedDate($job->acceptTime) ?? "-"}}</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="far fa-clock"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>ผู้รับแจ้ง</span><br>
                                    <span class='info-list-text'>{{$job->getTech->name ?? "-"}}</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="far fa-clock"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>สำเร็จเมื่อ</span><br>
                                    <span class='info-list-text'>{{$job->formattedDate($job->successTime) ?? "-"}}</span>
                                </div>
                            </li>
                        </ul>
                        <ul class='list-group flist f-thai'>
                            <li class="list-group-item list-group-item-action " id="style-4">
                                <h1>
                                    <i class="fab fa-linkedin"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>รายละเอียด</span>
                                    <span class='info-list-text'>{{$job->caseDetail}} Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos magni, alias beatae rem sed exercitationem. Similique debitis sunt modi veritatis eos, quaerat doloremque ipsum, recusandae odio voluptatem nemo. Vel, expedita.</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action ">
                                <h1>
                                    <i class="fas fa-map-marked-alt"></i>
                                </h1>
                                <div>
                                    <span class='info-list-title'>ที่อยู่</span>
                                    <span class='info-list-text'>{{$job->address}}</span>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
                <hr>
                <div class="row h500 mb-4">
                    <div class="col-4 h-100 bg-white">
                        <div class="row  f-thai">
                            <p class="p-2 h2 f-thai"> <b> สรุปค่าใช้จ่าย</b></p>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center my-3 ">
                                    <p>ค่าแรงเริ่มต้น</p>
                                    <p class="h5 text-right">฿{{number_format($job->wage,2)}} </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center my-3 ">
                                    <p>ช่างเทคนิค</p>
                                    <p class="h5 text-right">฿{{number_format($job->tech_wage,2)}}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center my-3 ">
                                    <p>ค่าอุปกรณ์ ({{$job->HardwareReport->amount}}) ชิ้น</p>
                                    <p class="h5 text-right">฿{{number_format($job->HardwareReport->total,2)}}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center my-3 ">
                                    <p>รวมทั้งสิ้น</p>
                                    <p class="h5 text-right">฿{{number_format($job->HardwareReport->ordertotal,2)}}</p>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-8 bg-white border-left ">
                        <div class="row ">
                            <p class="f-thai h2 p-2"><b>รายละเอียดการใช้อุปกรณ์</b></p>
                            <div class="col-12 bg-white scrollbar border-top" id="style-4">
                                <ul class='list-group eq-list f-thai my-3'>
                                    @if(count($job->Equipment()) > 0)
                                        @foreach($job->Equipment() as $item)
                                        <li class="list-group-item  my-2">
                                            <img src="{{$item->equipment->getCover()}}" alt="" class="w-100 h-100">
                                            <p> {{$item->equipment->name}}</p>
                                            <div class="text-right">
                                                {{$item->amount}} x {{number_format($item->equipment->price,2)}} <br>
                                                {{number_format($item->amount * $item->equipment->price,2)}}
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif()
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- About Section Button-->

    </section>
    <!-- personor Section-->

    <footer class="footer text-center">
        <div class="container">
            <div class="row full-width">
                <div class="col-12 text-center">
                    <span>Map</span>
                    <iframe width="100%" height="700" src="https://maps.google.com/maps?q={{$job->Latitude}},{{$job->Longitude}}&output=embed"></iframe>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright © Your Website 2020</small></div>
    </div>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
    </div>
    <!-- Portfolio Modals-->

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Contact form JS-->
    <script src="{{ asset('theme/frontend/assets/mail/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('theme/frontend/assets/mail/contact_me.js') }}"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('theme/frontend/js/scripts.js') }}"></script>
    <script src="{{ asset('theme/frontend/assets/sweetalerts/sweetalert2.min.js') }}"></script>


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
    </script>                    
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="_token" content="{{csrf_token()}}" />

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Custom styles for this template -->


    <!-- drop -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/dropimage/dropify/dropify.min.css') }}">
    <link href="{{ asset('theme/dropimage/dropify/account-setting.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom styles for this page -->
    <link href="{{ asset('theme/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/form.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        .table tbody tr{
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><i class="fas fa-home"></i></a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger f-thai" href="#portfolio">แจ้งซ่อม</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger f-thai" href="#about">ประวัติการแจ้งซ่อม</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger f-thai" href="#contact">ข้อมูลส่วนตัว</a></li>
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
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="" />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0 f-thai">ยินดีต้อนรับ</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0 f-thai">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</p>
        </div>
    </header>
    <!-- Portfolio Section-->
    <section class="page-section portfolio pt-5 " id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 f-thai">แจ้งซ่อม</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-bullhorn fa-w-18"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <form id="contactForm" name="sentMessage" novalidate="novalidate">
                @csrf
                <div class="row ">
                    <div class="col-8">
                        <div class="control-group">
                            <label for="country">ประเภทปัญหา</label>
                            <select name="select" id="" class='form-control f-thai' required="required">
                                <option value="">เลือก...</option>
                                @foreach($selects as $select)
                                <option value="{{$select->id}}">{{$select->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>รายละเอียดปัญหา</label>
                                <textarea class="form-control f-thai" id="detail" name='detail' rows="5" placeholder="รายละเอียดปัญหา" required="required" data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>ที่อยู่</label>
                                <textarea class="form-control f-thai" id="address" name='address' rows="5" placeholder="ที่อยู่" required="required" data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group mt-5">
                            <label for="detail">Latitude : <span id="Latitude"></span></label> <br>
                            <label for="detail">Longitude : <span id="Longitude"></span></label> <br>
                            <input type="hidden" name="Latitude" value="">
                            <input type="hidden" name="Longitude" value="">
                        </div>
                        <br />
                        <div id="success"></div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-xl w-50 mx-auto f-thai" id="sendMessageButton" type="submit">
                                แจ้งปัญหา
                            </button>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="detail" class="mt-4">ภาพประกอบ</label>
                        <input type="file" id="input-file-max-fs" name="select_file" class="dropify rounded shadow" data-max-file-size="2M" accept="image/gif, image/jpeg,image/png" />
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0 pt-5" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white f-thai">ประวัติการแจ้งซ่อม</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-chart-line"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row full-width">
                <div class="col-md-5 col-12">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="boxbox box-primary">
                                <div class="flex-item">
                                    <span>ประวัติการแจ้งงานทั้งหมด</span> <br>
                                </div>
                                <div class="flex-icon">
                                    <span class='badge badge-pill badge-total'> {{$cases->count()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="card shadow  mx-auto w-100 ">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary f-thai">กราฟรายงานการแจ้งซ่อมย้อนหลัง 6 เดือน</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="shadow rounded p-3 bg-white">
                        <div class="table-responsive">
                            <table class="table table-bordered f-thai table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th align="center">#</th>
                                        <th>ประเภทงาน</th>
                                        <th>ช่าง</th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cases as $key => $case)
                                    <tr onclick="window.location.href='/user/job/{{$case->JobId}}'" >
                                        <td align="center">{{$case->JobId}}</td>
                                        <td>{{$case->JobType->name}}</td>
                                        <td>{{($case->getTech)? $case->getTech->getFullname() : ''}}</td>
                                        <td>
                                            <span class='badge {{$case->StatusColor()}} text-white py-2 px-3 '>{{$case->JobStatus()}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- About Section Button-->
        </div>
    </section>
    <!-- Contact Section-->
    <section class="page-section pt-5" id="contact">
        <div class="container">
            <!-- Contact Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 f-thai">ข้อมูลส่วนตัว</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-id-card"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Contact Section Form-->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form id="userForm" name="sentMessage" novalidate="novalidate">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2 floating-label-form-group-with-value">
                                <label>ชื่อ</label>
                                <input class="form-control" id="name" value="{{$user->name}}" name='name' type="text" placeholder="ชื่อ" required="required" data-validation-required-message="กรุณากรอกชื่อ" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2 floating-label-form-group-with-value">
                                <label>นามสกุล</label>
                                <input class="form-control" value="{{$user->lastname}}" id="name" name='lastname' type="text" placeholder="นามสกุล" required="required" data-validation-required-message="กรุณากรอกนามสกุล" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2 floating-label-form-group-with-value">
                                <label>อีเมล์</label>
                                <input class="form-control" value="{{$user->email}}" id="email" name='email' type="email" placeholder="อีเมล์" required="required" data-validation-required-message="กรุณากรอกอีเมล์" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2 @if($user->address != null) floating-label-form-group-with-value @endif">
                                <label>ที่อยู่</label>
                                <textarea class="form-control f-thai" name='pfAddress' id="message" rows="5" placeholder="ที่อยู่" required="required">{{$user->address}}</textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2 @if($user->address != null) floating-label-form-group-with-value @endif">
                                <label>โทรศัพท์</label>
                                <input class="form-control" value="{{$user->phone}}" id="name" name='phone' type="number" placeholder="เบอร์โทรศัพท์" required="required" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br />
                        <div id="pfsuccess"></div>
                        <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">แก้ไข</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- personor Section-->

  
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row full-width">
                <div class="col-md-5">
                    <img src="{{asset('web_images/gear.jpg')}}" alt="" class='w-100 shadow rounded'>
                </div>
                <div class="col-md-7">
                    <div class='d-flex h-100'>
                        <p class='justify-content-center align-self-center f-thai'>
                            ทุกกระบวนการเราจะทำความเข้าใจถึงโจทย์ แล้วหาแนวทางที่เหมาะสม ตอบโจทย์ของลูกค้า โดยใช้ลูกค้าเป็นที่ตั้ง เพราะคุณรู้และความสามารถในธุรกิจคุณ เรารู้ในเรื่องระบบเทคโนโลยี การสื่อสารที่เข้าใจรับฟัง และนำเสนอแนวทางที่จะเป็นประโยชน์ จะช่วยให้การทำงานประสบความสำเร็จสูงสุด
                        </p>
                    </div>
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


    <script src="{{ asset('theme/dropimage/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('theme/dropimage/dropify/bootstrap-tagsinput.min.js') }}"></script>

    <script src="{{ asset('theme/backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


    <script src="{{ asset('theme/backend/vendor/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        var label = @json($label);
        var data = @json($data);
        //    data = [6,1,3]
        console.log(label, data);
    </script>
    <script src="{{ asset('js/chart-area-demo.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 6,
                "bLengthChange": false,
            });
            
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': false,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '3000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
                'progressBar': true,
            }

        });
       
        $("body").on('submit', "#userForm", function(e) {
            e.preventDefault();
            let name = $("[name='name']").val();
            let lastname = $("[name='lastname']").val();
            let email = $("[name='email']").val();
            if (!name || !lastname || !email) {
                Cttoas('error', 'กรุณากรอกข้อมูลให้ครบถ้วน')
                return
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('user.update') }}",
                type: "PUT",
                data: $(this).serialize(),
                success: function(respone) {
                    if (respone.status) {
                        $("#pfsuccess").html("<div class='alert alert-success'>");
                        $("#pfsuccess > .alert-success")
                            .html(
                                "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                            )
                            .append("</button>");
                        $("#pfsuccess > .alert-success").append(
                            "<strong>บันทึกสำเร็จ </strong>"
                        );
                        $("#pfsuccess > .alert-success").append("</div>");

                    } else {
                        $("#pfsuccess").html("<div class='alert alert-danger'>");
                        $("#pfsuccess > .alert-danger")
                            .html(
                                "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                            )
                            .append("</button>");
                        $("#pfsuccess > .alert-danger").append(
                            $("<strong>").text("บันทึกไม่สำเร็จ")
                        );
                        $("#pfsuccess > .alert-danger").append("</div>");
                    }
                },
                error: function() {

                }
            })
        });
        $("body").on('submit', "#contactForm", function(e) {
            e.preventDefault();
            let detail = $("[name='detail']").val();
            let address = $("[name='address']").val();
            let select = $("[name='select']").val();
            let img = $("[name='select_file']").val();
            if (!detail || !address || !select || !img) {
                Cttoas('error', 'กรุณากรอกข้อมูลให้ครบถ้วน')
                return
            }
            $.ajax({
                url: "{{ route('user.store') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(respone) {
                    if (respone.status) {
                        // Cttoas('success', 'บันทึกสำเร็จ')

                        toastr.success('บันทึกสำเร็จ');
                        $("#success").html("<div class='alert alert-success'>");
                        $("#success > .alert-success")
                            .html(
                                "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                            )
                            .append("</button>");
                        $("#success > .alert-success").append(
                            "<strong>บันทึกสำเร็จ </strong>"
                        );
                        $("#success > .alert-success").append("</div>");
                        //clear all fields
                        $("#contactForm").trigger("reset");
                        $("[name='detail']").closest(".form-group").removeClass('floating-label-form-group-with-value')
                        $("[name='address']").closest(".form-group").removeClass('floating-label-form-group-with-value')
                        $(".dropify-clear").click()
                        setTimeout(() => {
                            location.reload();
                        }, 3000)
                    } else {
                        $("#success").html("<div class='alert alert-danger'>");
                        $("#success > .alert-danger")
                            .html(
                                "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;"
                            )
                            .append("</button>");
                        $("#success > .alert-danger").append(
                            $("<strong>").text("บันทึกไม่สำเร็จ")
                        );
                        $("#success > .alert-danger").append("</div>");
                    }
                },
                error: function() {
                    $("#contactForm").trigger("reset");
                }
            })
        })

        $('.dropify').dropify({
            messages: {
                'default': 'อัปโหลดภาพประกอบ',
                'remove': '<i class="fas fa-times"></i>',
                'replace': 'Upload or Drag n Drop'
            }
        });


        currentLocation()

        function currentLocation() {
            navigator.geolocation.getCurrentPosition(function(position) {
                $("span#Latitude").text(position.coords.latitude)
                $("span#Longitude").text(position.coords.longitude)
                $("input[name='Latitude']").val(position.coords.latitude)
                $("input[name='Longitude']").val(position.coords.longitude)
            });
        }




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
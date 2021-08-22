@extends('templates.admin')

@section('title','Dashboard')

@section('head')
<style>
    .card-header {
        background-color: #fff;
    }


    .gold {
        color: #FFD700;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center ">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                ผู้ใช้งาน</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center mt-3">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1 f-thai">
                                ช่างเทคนิค </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tech}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-cog fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1 f-thai">
                                รายได้ทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($salary,2)}}</div>

                            <div class="text-xs font-weight-bold text-dark  mb-1 f-thai mt-2">
                                รายได้วันนี้ </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($today_salary,2)}}</div>
                        </div>


                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x gold"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center ">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1 f-thai">งานใหม่
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$newJob}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-clock fa-2x text-info"></i>
                        </div>
                    </div>

                    <div class="row no-gutters align-items-center mt-3">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 f-thai">
                                งานทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$allJob}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" style="position:relative">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center ">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark  mb-1 f-thai">
                                {{max($label)}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{max($data)}} <small>งาน</small> </div>

                            <div class="text-xs font-weight-bold text-dark py-2 mt-2 f-thai">
                                {{min($label)}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{min($data)}} <small>งาน</small></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x shadow-sm gold rounded-circle bg-white p-3"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <!-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary f-thai">การแจ้งซ่อมแยกตามประเภท</h6>
                </div>
                <div class="card-body">
                    @foreach($jobTypedata as $key => $value)
                    <h4 class="small font-weight-bold f-thai">{{$jobTypelabel[$key]}} <span class="float-right">{{$value}} %</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$value}}%" aria-valuenow="{{$value}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @endforeach
                </div>
            </div> -->
            <div class="card shadow  mx-auto w-100 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary f-thai">กราฟรายงานการแจ้งซ่อมย้อนหลัง 1 ปี</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary f-thai">สถานะงานใหม่</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">

                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> งานใหม่
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> กำลังดำเนินการ
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')


<script src="{{ asset('theme/backend/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script>
    var Statuslabels = @json($jobStatuslabel);
    var Statusdata = @json($jobStatusdata);
    var jobTypedata = @json($jobTypedata);
    var jobTypelabel = @json($jobTypelabel);


    var label = @json($label);
    var data = @json($data);
</script>
<script src="{{ asset('theme/backend/js/demo/chart-pie-demo.js')}}"></script>
<script src="{{ asset('js/chart-area-demo2.js') }}"></script>

@endsection
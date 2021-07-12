@extends('templates.tech')

@section('title','Dashboard')

@section('head')
<style>
    .card{
        min-height: 100%;
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
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 f-thai">
                            ระยะเวลาในการปฏิบัติงานทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$totaltime}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
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
                                ระยะเวลาในการปฏิบัติงานสั้นที่สุด</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $timearr ? min($timearr) : '0' }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1 f-thai">ระยะเวลาในการปฏิบัติงานมากที่สุด
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ $timearr ? max($timearr) : '0' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 f-thai">
                                ระยะเวลาเฉลี่ย</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$avg ?? 0}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary f-thai">การแจ้งซ่อมแยกตามประเภท</h6>
                </div>
                <div class="card-body">
                    @foreach($jobTypedata as $key => $value)
                    <h4 class="small font-weight-bold f-thai">{{$jobTypelabel[$key] }} ({{$value}}) <span class="float-right">{{number_format(($value * 100) / $jobs,2)}} %</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{number_format(($value * 100) / $jobs,2)}}%" aria-valuenow="{{number_format(($value * 100) / $jobs,2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary f-thai">งานทั้งหมด ({{$jobs}})</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> 
                            Success 
                        </span>
                      
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> 
                            Cancel 
                        </span>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    var total = @json($jobs);
    var success = @json($success);
    var cancel = @json($cancel);
    

</script>
<script src="{{ asset('theme/backend/vendor/chart.js/Chart.min.js')}}"></script>

<script src="{{ asset('theme/backend/js/demo/techdashboard-chart-pie-demo.js')}}"></script>
@endsection
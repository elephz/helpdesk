@extends('templates.tech')

@section('title','Dashboard')

@section('head')
<style>
    li {
        table-layout: fixed;
        padding: 10px 5px;
        display: table;
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
        font-size: 0.8rem;
    }

    li .info-list-title {
        min-width: 108px;
        display: table-cell;
        color: #ff5938;
        font-size: 0.8rem;
    }
    .text-xs{
        font-size: 18px;
    }
</style>
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 f-thai">สรุปการดำเนินงาน</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-md-4 col-12 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1 f-thai">
                                ข้อมูลผู้แจ้ง</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row">
                        <ul class='list-unstyled mt-3'>
                            <li>
                                <span class='info-list-title text-primary'>ชื่อ</span>
                                <span class='info-list-text'>{{$job->getUser->name}}</span>
                            </li>
                            <li>
                                <span class='info-list-title text-primary'>แจ้งเมื่อ</span>
                                <span class='info-list-text'> {{$job->formattedDate($job->created_at)}}</span>
                            </li>
                            <li>
                                <span class='info-list-title text-primary'>รายละเอียด</span>
                                <span class='info-list-text'>{{$job->caseDetail}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4 col-12 mb-4">

            


            <div class="card border-left-primary shadow py-2 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                รับงานเมื่อ</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        
                    </div>
                    <div class="row">
                    {{$job->formattedDate($job->acceptTime)}}
                    </div>
                </div>
            </div>


            <div class="card border-left-primary shadow py-2 my-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                สำเร็จเมื่อ</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        
                    </div>
                    <div class="row">
                    {{$job->formattedDate($job->successTime)}}
                    </div>
                </div>
            </div>

            <div class="card border-left-primary shadow py-2 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                ระยะเวลาทั้งสิ้น</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        
                    </div>
                    <div class="row">
                        {{$job->diffDate($job->acceptTime,$job->successTime)}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1 f-thai">หมายเหตุ
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row">
                        {{$job->note ?? "-"}}
                    </div>
                </div>
            </div>
        </div>


    </div>




</div>
@endsection

@section('script')
<script>
    $(function() {
        $('button').tooltip();
    });
</script>
@endsection
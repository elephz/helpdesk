@extends('templates.tech')

@section('title','Dashboard')

@section('head')
<style>
    .care {
        overflow-y: auto;
    }

    li {
        padding: 10px 5px;
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
        font-size: 0.8rem;
    }

    li .info-list-title {
        display: block;
        color: #ff5938;
        font-size: 0.8rem;
    }


    .text-xs {
        font-size: 18px;
    }

    .tree-flex .card {
        width: 100%;
        margin: 0 5px;
    }
   
    ul.eq-list .list-group-item  {
        display: grid;
        grid-template-columns: 100px 1fr 1fr;
        grid-column-gap: 15px;
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
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 f-thai">สรุปการดำเนินงาน</h1>
    </div>

    <!-- Content Row -->
    <div class="row mb-5">
        <div class="col-6">
            <div class="row">
                <div class="col-md-6 col-12 mb-4 h-100">
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
                                        <span class='info-list-text pl-2'>{{$job->getUser->name}}</span>
                                    </li>
                                    <li>
                                        <span class='info-list-title text-primary'>แจ้งเมื่อ</span>
                                        <span class='info-list-text pl-2'> {{$job->formattedDate($job->created_at)}}</span>
                                    </li>
                                    <li>
                                        <span class='info-list-title text-primary'>รายละเอียด</span>
                                        <span class='info-list-text pl-2'>{{$job->caseDetail}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 mb-4">


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
                            <div class="row f-thai">
                                {{$job->note ?? "-"}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="d-flex justify-content-between tree-flex w-100">
                    <div class="card border-left-primary shadow py-2 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                        รับงานเมื่อ</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                            </div>
                            <span>
                                {{$job->formattedDate($job->acceptTime)}}
                            </span>
                        </div>
                    </div>

                    <div class="card border-left-primary shadow py-2 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                        สำเร็จเมื่อ</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>

                            </div>
                            <span>
                                {{$job->formattedDate($job->successTime)}}
                            </span>
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
                            <span>
                                {{$job->diffDate($job->acceptTime,$job->successTime)}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-flex justify-content-between tree-flex w-100">
                    <div class="card  shadow py-2 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                        ค่าแรงเริ่มต้น</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                            </div>
                            <span>
                                {{number_format($job->wage,2)}}
                            </span>
                        </div>
                    </div>

                    <div class="card  shadow py-2 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                        ช่างเทคนิค</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>

                            </div>
                            <span>
                            {{number_format($job->tech_wage,2)}}
                            </span>
                        </div>
                    </div>

                    <div class="card  shadow py-2 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                        อุปกรณ์ ({{$job->HardwareReport->amount}}) ชิ้น</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>

                            </div>
                            <span>
                            {{number_format($job->HardwareReport->total,2)}}
                            </span>
                        </div>
                    </div>
                    <div class="card  shadow py-2 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1 f-thai">
                                        รวมทั้งสิ้น</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>

                            </div>
                            <span >
                            {{number_format($job->HardwareReport->ordertotal,2)}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1 f-thai">
                                รวมทั้งสินค้า</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row">
                        <ul class='list-group eq-list f-thai my-3 w-100 scrollbar' id="style-4">
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
@endsection

@section('script')
<script>
    $(function() {
        $('button').tooltip();
    });
</script>
@endsection
@extends('templates.admin')

@section('title','Dashboard')

@section('head')
<style>
    img {
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

    ul.list-unstyled li .info-list-title {
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
        align-items: center;
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
    .h500{
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
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 f-thai">รายละเอียด</h1>
</div>
<div class="row mb-4">
    <div class="col-md-5 col-12">
        <div class="row mb-3">
            <img src="{{$jobs->getImg()}}" alt="" class='w-100 shadow rounded'>
        </div>

    </div>
    <div class="col-md-7 col-12">
        <ul class='list-group alist f-thai'>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fas fa-cog"></i>
                </h1>
                <div>
                    <span class='info-list-title'>ประเภทงาน</span>
                    <span class='info-list-text'>{{$jobs->JobType->name}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-address-book"></i>
                </h1>
                <div>
                    <span class='info-list-title'>ชื่อ</span>
                    <span class='info-list-text'>{{$jobs->getUser->name}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fas fa-phone-square"></i>
                </h1>
                <div>
                    <span class='info-list-title'>โทรศัพท์</span>
                    <span class='info-list-text'>{{$jobs->getUser->phone}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-bookmark"></i>
                </h1>
                <div>
                    <span class='info-list-title'>สถานะ</span>
                    <span class='info-list-text badge badge-pill badge-primary {{$jobs->StatusColor()}} text-white py-2 px-3'>{{$jobs->JobStatus()}}</span>
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
                    <span class='info-list-text'>{{$jobs->formattedDate($jobs->created_at)}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-clock"></i>
                </h1>
                <div>
                    <span class='info-list-title'>รับแจ้งเมื่อ</span><br>
                    <span class='info-list-text'>{{$jobs->formattedDate($jobs->acceptTime) ?? "-"}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-clock"></i>
                </h1>
                <div>
                    <span class='info-list-title'>ผู้รับแจ้ง</span><br>
                    <span class='info-list-text'>{{$jobs->getTech->name ?? "-"}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-clock"></i>
                </h1>
                <div>
                    <span class='info-list-title'>สำเร็จเมื่อ</span><br>
                    <span class='info-list-text'>{{$jobs->formattedDate($jobs->successTime) ?? "-"}}</span>
                </div>
            </li>
        </ul>
        <ul class='list-group flist f-thai'>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fab fa-linkedin"></i>
                </h1>
                <div>
                    <span class='info-list-title'>รายละเอียด</span>
                    <span class='info-list-text'>{{$jobs->caseDetail}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fas fa-map-marked-alt"></i>
                </h1>
                <div>
                    <span class='info-list-title'>ที่อยู่</span>
                    <span class='info-list-text'>{{$jobs->address}}</span>
                </div>
            </li>
        </ul>

    </div>
</div>
<div class="row h500 mb-4">
    <div class="col-4 h-100 bg-white">
        <div class="row  f-thai">
            <p class="p-2">สรุปค่าใช้จ่าย</p>
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center my-3 ">
                    <p>ค่าแรงเริ่มต้น</p>
                    <p class="h4 text-right"><b>฿{{number_format($jobs->wage,2)}} </b></p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-3 ">
                    <p>ช่างเทคนิค</p>
                    <p class="h4 text-right"><b>฿{{number_format($jobs->tech_wage,2)}}</b></p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-3 ">
                    <p>ค่าอุปกรณ์ ({{$jobs->HardwareReport->amount}}) ชิ้น</p>
                    <p class="h4 text-right"><b>฿{{number_format($jobs->HardwareReport->total,2)}}</b></p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-3 ">
                    <p>รวมทั้งสิ้น</p>
                    <p class="h4 text-right"><b>฿{{number_format($jobs->HardwareReport->ordertotal,2)}}</b></p>
                </div>


            </div>
        </div>
    </div>
    <div class="col-8 bg-white border-left ">
        <div class="row ">
            <div class="col-12  mt-2 ml-2">
                <p class="f-thai"><b>รายละเอียดการใช้อุปกรณ์</b></p>
            </div>
            <div class="col-12 bg-white scrollbar border-top" id="style-4">
                <ul class='list-group eq-list f-thai my-3'>
                    @if(count($jobs->Equipment()) > 0)
                    @foreach($jobs->Equipment() as $item)
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
<div class="row">
    <div class="col text-center">
        <span>Map</span>
        <iframe width="100%" height="700" src="https://maps.google.com/maps?q={{$jobs->Latitude}},{{$jobs->Longitude}}&output=embed"></iframe>
    </div>
</div>
@endsection

@section('script')

@endsection
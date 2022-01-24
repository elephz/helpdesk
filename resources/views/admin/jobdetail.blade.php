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
        grid-template-columns: 100px 1fr;
        grid-gap: 10px;
        border: unset;
        border-radius: 15px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
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
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 f-thai">รายละเอียด 1</h1>
</div>
<div class="row">
    <div class="col-md-5 col-12">
        <div class="row">
            <img src="{{$jobs->getImg()}}" alt="" class='w-100 shadow rounded'>
        </div>
        <div class="row">
            <div class="col text-center">
                <span>Map</span>
                <iframe width="100%" height="500" src="https://maps.google.com/maps?q={{$jobs->Latitude}},{{$jobs->Longitude}}&output=embed"></iframe>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-12">
        <ul class='list-group flist'>
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
        <ul class="list-group alist my-4">
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-clock"></i>
                </h1>
                <div>
                    <span class='info-list-title'>แจ้งเมื่อ</span>
                    <span class='info-list-text'>{{$jobs->formattedDate($jobs->created_at)}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-clock"></i>
                </h1>
                <div>
                    <span class='info-list-title'>รับแจ้งเมื่อ</span>
                    <span class='info-list-text'>{{$jobs->formattedDate($jobs->acceptTime) ?? "-"}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-clock"></i>
                </h1>
                <div>
                    <span class='info-list-title'>ผู้รับแจ้ง</span>
                    <span class='info-list-text'>{{$jobs->getTech->name ?? "-"}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-clock"></i>
                </h1>
                <div>
                    <span class='info-list-title'>สำเร็จเมื่อ</span>
                    <span class='info-list-text'></span>
                </div>
            </li>
        </ul>
        <ul class='list-group tlist'>
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
<div class="row">
    <div class="col text-center">
        <span>Map</span>
        <iframe width="100%" height="700" src="https://maps.google.com/maps?q={{$jobs->Latitude}},{{$jobs->Longitude}}&output=embed"></iframe>
    </div>
</div>
<div class="row my-4">
    <div class="col-md-10 col-12 mx-auto">
        <table  class="table table-bordered rounded">
            <thead>
                <tr>
                    <th class="f-thai">แจ้งเมื่อ</th>
                    <th class="f-thai">รับแจ้งเมื่อ</th>
                    <th class="f-thai">ผู้รับแจ้ง</th>
                    <th class="f-thai">สำเร็จเมื่อ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$jobs->formattedDate($jobs->created_at)}}</td>
                    <td>{{$jobs->formattedDate($jobs->acceptTime) ?? "-"}}</td>
                    <td>{{$jobs->getTech->name ?? "-"}}</td>
                    <td>{{$jobs->formattedDate($jobs->successTime)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')

@endsection
@extends('templates.admin')

@section('title','Dashboard')

@section('head')
<style>
    img {
        width: 100%;
        height: 350px;
        object-fit: cover;
    }

    li {
        table-layout: fixed;
        padding: 10px 5px;
        display: table;
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
    }

    li .info-list-title {
        min-width: 108px;
        display: table-cell;
        color: #ff5938;
    }
    table > thead > tr > th{
        text-align: center;
    }
    li .info-list-text {
        color: #888ea8;
    }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 f-thai">รายละเอียด</h1>
</div>
<div class="row">
    <div class="col-md-5 col-12">
        <img src="{{asset('images/'.$jobs->image)}}" alt="" class='w-100 shadow rounded'>
    </div>
    <div class="col-md-7 col-12">
        <ul class='list-unstyled mt-3'>
            <li>
                <span class='info-list-title'>ประเภทงาน</span>
                <span class='info-list-text'>{{$jobs->JobType->name}}</span>
            </li>
            <li>
                <span class='info-list-title'>รายละเอียด</span>
                <span class='info-list-text'>{{$jobs->caseDetail}}</span>
            </li>
            <li>
                <span class='info-list-title'>ที่อยู่</span>
                <span class='info-list-text'>{{$jobs->address}}</span>
            </li>
            <li>
                <span class='info-list-title'>ชื่อ</span>
                <span class='info-list-text'>{{$jobs->getUser->name}}</span>
            </li>
            <li>
                <span class='info-list-title'>โทรศัพท์</span>
                <span class='info-list-text'>{{$jobs->getUser->phone}}</span>
            </li>
            <li>
                <span class='info-list-title'>สถานะ</span>
                <span class='info-list-text badge badge-pill badge-primary {{$jobs->StatusColor()}} text-white py-2 px-3'>{{$jobs->JobStatus()}}</span>
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
                    <th>แจ้งเมื่อ</th>
                    <th>รับแจ้งเมื่อ</th>
                    <th>ผู้รับแจ้ง</th>
                    <th>สำเร็จเมื่อ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$jobs->formattedDate($jobs->created_at)}}</td>
                    <td>{{$jobs->formattedDate($jobs->acceptTime) ?? "-"}}</td>
                    <td>{{$jobs->getTech->name ?? "-"}}</td>
                
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')

@endsection
@extends('templates.admin')

@section('title','Dashboard')

@section('head')
<style>
    body {
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
    }

    .badge {
        padding: 10px;
        transition: 0.3s;
    }

    .badge:hover {
        transform: scale(1.1);
    }

    .badge i {
        font-size: 24px;
    }

    thead tr td {
        font-weight: bold;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #dc3545;
        content: attr(data-on);
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #dc3545;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .content li {
        table-layout: fixed;
        padding: 10px 5px;
        display: table;
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
    }

    .content li .info-list-title {
        min-width: 108px;
        display: table-cell;
        color: #ff5938;
    }

    .content li .info-list-text {
        color: #888ea8;
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .table tbody tr {
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-12 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold f-thai">???????????????????????????????????????</h6>
            </div>
            <div class="card-body">
                <div class="row content">
                    <ul class='list-unstyled mt-3'>
                        <li>
                            <span class='info-list-title'>????????????</span>
                            <span class='info-list-text'>{{$user->getFullname()}}</span>
                        </li>
                        <li>
                            <span class='info-list-title'>????????????????????????</span>
                            <span class='info-list-text'>{{$user->phone}}</span>
                        </li>
                        <li>
                            <span class='info-list-title'>??????????????????</span>
                            <span class='info-list-text'>{{$user->email}}</span>
                        </li>
                        <li>
                            <span class='info-list-title'>?????????????????????</span>
                            <span class='info-list-text'>{{$user->address}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-12 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold f-thai">?????????????????????????????????????????????????????? ({{$user->UserJob->count()}})</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered f-thai table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>???????????????????????????</th>
                                <th>????????????</th>
                                <th>???????????????</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->UserJob as $key => $case)
                            <tr onclick="window.location.href='/admin/jobs/detail/{{$case->id}}'" >
                                <td class="text-center">{{$case->JobId}}</td>
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
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
@extends('templates.admin')

@section('title','Dashboard')

@section('head')
<link href="{{ asset('css/loader.css') }}" rel="stylesheet">

<style>
    a.list-group-item-action {
        cursor: pointer;
        transition: .4s;
    }

    a.list-group-item-action:hover,
    a.list-group-item-action.active {
        padding-left: 30px;
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
    .h400{
        height: 400px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold  f-thai">งานปัจจุบัน</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush" id="list-tab" role="tablist">
                    @if($user->getTechCount())
                        @foreach($user->getTechCount()->get() as $indexList => $jobList)
                        <a class="list-group-item flex-column f-thai align-items-start list-group-item-action {{$indexList == 0 ? 'active' : ''}}" id="list-{{$indexList}}-list" data-toggle="list" href="#list-{{$indexList}}" role="tab" aria-controls="{{$indexList}}">

                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">#{{$jobList->JobId}}</h5>
                                <small class="text-right">{{ \Carbon\Carbon::parse($jobList->assginTime)->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{$jobList->JobType->name}}</p>
                            <small> <i class="far fa-user mr-1"></i> {{$jobList->getUser->name}} </small>
                        </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold  f-thai">รายละเอียดงาน</h6>
            </div>
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    @if($user->getTechCount())
                        @foreach($user->getTechCount()->get() as $index => $jobDetail)
                        <div class="tab-pane fade show {{$index == 0 ? 'active' : ''}}" id="list-{{$index}}" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="row">
                                <div class="col-12">
                                    <ul class='list-unstyled mt-3'>
                                        <li>
                                            <span class='info-list-title'>Job ID</span>
                                            <span class='info-list-text h3'> <b> #{{$jobDetail->JobId}} </b></span>
                                        </li>
                                        <li>
                                            <span class='info-list-title'>ประเภทงาน</span>
                                            <span class='info-list-text'>{{$jobDetail->JobType->name}}</span>
                                        </li>
                                        <li>
                                            <span class='info-list-title'>รายละเอียด</span>
                                            <span class='info-list-text'>{{$jobDetail->caseDetail}}</span>
                                        </li>
                                        <li>
                                            <span class='info-list-title'>ที่อยู่</span>
                                            <span class='info-list-text'>{{$jobDetail->address}}</span>
                                        </li>
                                        <li>
                                            <span class='info-list-title'>ชื่อ</span>
                                            <span class='info-list-text'>{{$jobDetail->getUser->name}}</span>
                                        </li>
                                        <li>
                                            <span class='info-list-title'>โทรศัพท์</span>
                                            <span class='info-list-text'>{{$jobDetail->getUser->phone}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="h400 d-flex w-100 justify-content-center">
                                        <img src="{{$jobDetail->getImg()}}" alt="" class='mw-100 mh-100 shadow rounded mx-auto'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // $('#dataTable').DataTable();

        $('#myList a').on('click', function(e) {
            e.preventDefault()

            $(this).tab('show')
        })

    });
</script>
@endsection
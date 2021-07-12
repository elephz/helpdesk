@extends('templates.tech')

@section('title','Dashboard')

@section('head')
<link href="{{ asset('css/modalSix.css') }}" rel="stylesheet">
<link href="{{ asset('css/loader.css') }}" rel="stylesheet">

<style>
    #btn {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
    }

    .modal-body {
        position: relative;
    }

    .top-right {
        position: absolute;
        top: 0px;
        right: 0px;
        font-size: 12px;
    }
</style>
@endsection

@section('modal')
<div id="modal-container">
    <div class="modal-background">

        <div class="modal">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <span class="f-thai">รายละเอียดการดำเนินงาน</span>
                <i class="fas fa-times"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <div class="shadow-sm rounded p-4">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table borderless h-100" id="dataTable2" width="100%" cellspacing="0">
                                        <thead class="bg-light text-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>ชื่อ</th>
                                                <th>จำนวนงาน</th>
                                                <th>มอบหมายงาน</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <form action="/action_page.php" class="w-100 text-left">
                            <div class="form-group">
                                <label for="email">รายละเอียด</label>
                                <textarea name="detail" id="email" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 f-thai">จัดการงานแจ้งปัญหา</h1>
</div>
<div class="row">
    <div class="col-12 col-md-12 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary f-thai">งานที่ได้รับมอบหมาย</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered f-thai" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center">#</th>
                                <th>ประเภท</th>
                                <th>วันที่แจ้ง</th>
                                <th>ผู้แจ้ง</th>
                                <th align="center">สถานะ</th>
                                <th align="center">รายละเอียด</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $key => $value)
                            <tr id="{{$value->id}}">
                                <td align="center" id="index">{{$key+1}}</td>
                                <td>{{$value->JobType->name}}</td>
                                <td>{{$value->formattedDate($value->created_at)}}</td>
                                <td>{{$value->getUser->name}}</td>
                                <td align="center" id='status'>
                                    <span class='info-list-text w-100 badge badge-pill badge-primary {{$value->StatusColor()}} text-white py-2 px-3'>{{$value->JobStatus()}}</span>
                                </td>
                                <td align="center">
                                    <a class="btn btn-primary" href="{{route('tech.jobs.detail',$value->id)}}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td align="center" id='btn'>
                                    @switch($value->jobStatus)

                                    @case(1)
                                    <button class="btn btn-primary" title="รับงาน" onclick="acceptJob('{{$value->id}}')">
                                        <i class="fas fa-vote-yea"></i>
                                    </button>

                                    <button class="btn btn-danger" title="ปฏิเสธงาน" onclick="cancelJob('{{$value->id}}')">
                                        <i class="far fa-times-circle"></i>
                                    </button>
                                    @break

                                    @case(2)
                                    <button class="btn btn-success" title="ดำเนินการเสร็จสิ้น" onclick="successJob('{{$value->id}}')">
                                        <i class="far fa-check-square"></i>
                                    </button>

                                    <button class="btn btn-danger" title="ปฏิเสธงาน" onclick="cancelJob('{{$value->id}}')">
                                        <i class="far fa-times-circle"></i>
                                    </button>
                                    @break

                                    @case(3)
                                    <a href="{{route('tech.Jobs.success.detail',$value->id)}}" class="btn btn-success" title="สรุปการดำเนินงาน">
                                        <i class="fas fa-clipboard"></i>
                                    </a>

                                    @break

                                    @case(4)
                                    <button class="btn btn-danger" title="หมายเหตุการยกเลิก" onclick="getCancelMsg('{{$value->id}}')">
                                        <i class="fas fa-clipboard"></i>
                                    </button>
                                    @break
                                    @endswitch
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-thai" id="exampleModalLabel">หมายเหตุการยกเลิก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body f-thai">
                <p>
                    <span id='cancel-note'></span>
                </p>
                <div class='top-right'>
                    <span id='cancel-time'></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        $('button').tooltip();

        $("#modal-container .modal-background .modal .modal-header i").click(() => {
            console.log("hey");
            $(".two").addClass('out');
            $('body').removeClass('modal-active');
        })
    });

    function successReport(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'GET',
            url: `Jobs/getSuccessReport/detail/${id}`,
            success: function(response) {
                if (response.status) {
                    $("#cancel-note").text(response.msg)
                    $("#cancel-time").text(response.time)
                    $("#exampleModal").modal('show')
                } else {

                }

            },
            error: function(e) {
                console.log(e)
            }
        });
    }

    function getCancelMsg(id) {
        console.log(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'GET',
            url: `Jobs/getCancelMsg/detail/${id}`,
            success: function(response) {
                if (response.status) {
                    $("#cancel-note").text(response.msg)
                    $("#cancel-time").text(response.time)
                    $("#exampleModal").modal('show')
                } else {

                }

            },
            error: function(e) {
                console.log(e)
            }
        });
    }

    function cancelJob(id) {

        swal.mixin({
            input: 'text',
            confirmButtonText: 'ยกเลิก',
            cancelButtonText: 'ปิด',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showCancelButton: true,
            // progressSteps: ['1', '2', '3'],
            padding: '2em',
        }).queue([{
            title: 'ยกเลิกการแจ้งซ่อม',
            text: 'หมายเหตุการยกเลิกแจ้งซ่อม'
        }, ]).then(function(result) {
            if (result.value) {
                let msg = result.value[0];
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'PUT',
                    url: `{{route('tech.Jobs.cancel')}}`,
                    cache: false,
                    data: {
                        id,
                        msg
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            Cttoas('success', 'ยกเลิกสำเร็จ')
                            location.reload();
                        } else {
                            Cttoas('success', 'ยกเลิกไม่สำเร็จ')
                        }

                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            }
        })


    }

    function successJob(id) {

        $('#modal-container').removeAttr('class').addClass("two");
        $('body').addClass('modal-active');
        return
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'PUT',
            url: `Jobs/success/${id}`,
            cache: false,
            success: function(response) {
                console.log(response);
                if (response.status) {
                    Cttoas('success', 'บันทึกสำเร็จ')
                    setTimeout(() => {
                        location.reload();
                    }, 500)
                } else {
                    if (response.type == 'activedted') {
                        Cttoas('error', 'เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง')
                    } else {
                        console.log('error');
                    }
                }

            },
            error: function(e) {
                console.log(e)
            }
        });
    }

    function acceptJob(id) {
        swal({
            title: 'รับงานแจ้งซ่อม',
            html: `<span>ยืนยันการรับงานแจ้งซ่อม</span>`,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ปิด',
            padding: '2em'
        }).then(function(result) {

            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'PUT',
                    url: `Jobs/${id}`,
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            Cttoas('success', 'บันทึกสำเร็จ')
                            setTimeout(() => {
                                location.reload();
                            }, 500)
                        } else {
                            if (response.type == 'activedted') {
                                Cttoas('error', 'เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง')
                            } else {
                                console.log('error');
                            }
                        }

                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            }
        })
    }
</script>
@endsection
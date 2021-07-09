@extends('templates.admin')

@section('title','Dashboard')

@section('head')
<link rel="stylesheet" href="{{asset('plugin/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugin/bootstrap-select/bootstrap-select.min.css')}}">
<link href="{{ asset('css/modalSix.css') }}" rel="stylesheet">

<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<style>
    table>thead>tr>th,
    table>tbody>tr>td {
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
    }

    .btn-round {
        font-size: .8rem;
        border-radius: 10rem;
        padding: .75rem 1rem;
    }

    #dataTable_filter {
        display: none;
    }

    .custom-select {
        width: 39%;
    }

    .badge {
        font-size: 90%;
    }

    .bootstrap-select.btn-group>.dropdown-toggle {
        margin-bottom: 0px !important;
    }
</style>
@endsection
@section('modal')
<div id="modal-container">
    <div class="modal-background">
        <div class="modal">
            <a class='colse-modal' >
                <i class="fas fa-times"></i>
            </a>
            <h2>I'm a Modal</h2>
            <p>Hear me roar.</p>
            
        </div>
    </div>
</div>
@endsection
@section('content')



<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 f-thai">จัดการงานแจ้งปัญหา</h1>
</div>
<!-- alert row -->
@if(Session::has('message'))
<div class="row">
    <div class="col-12">
        <div class="alert {{Session::has('alert-class')?Session::get('alert-class'):'alert-success'}} alert-dismissible fade show" role="alert">
            <!-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. -->
            {{Session::get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif
<!-- alert row -->
<!-- modal insert-->
<div class="modal fade" id="ModalInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <form class="user" method="POST" id="insert-form">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-8 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name='name' id="exampleName" placeholder="ประเภทงาน" required>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-user btn-block" id="btn-save">
                                เพิ่ม
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- modal insert-->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center">#</th>
                                <th>ประเภท</th>
                                <th>วันที่แจ้ง</th>
                                <th>ผู้แจ้ง</th>
                                <th>สถานะ</th>
                                <th>ช่าง</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $key => $value)
                            <tr id="{{$value->id}}">
                                <td align="center" id="index">{{$key+1}}</td>
                                <td>{{$value->JobType->name}}</td>
                                <td>{{$value->formattedDate_time()[0]}} <br> <span style="font-size: 12px;">{{$value->formattedDate_time()[1]}}</span></td>
                                <td>{{$value->getUser->name}}</td>
                                <!-- <td>{{$value->JobStatus()}}</td> -->
                                <td class='text-center' id="td-stt">
                                    <span class='badge {{$value->StatusColor()}} text-white py-2 px-3 '>{{$value->JobStatus()}}</span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-cicle button-test"><i class="far fa-plus-square"></i></button>
                                    <!-- <select class="form-control basic">
                                        <option value="">กรุณาเลือก</option>
                                        @foreach($tech as $item)
                                        <option value='{{$item->id}}'{{(($value->techId == $item->id) ? 'selected':'')}} >
                                            {{$item->getFullname()}} <b>({{count($item->getTechCount)}})</b> 
                                        </option>
                                        @endforeach
                                    </select> -->
                                </td>
                                <td align="center">
                                    <a class="btn btn-primary" href="{{route('admin.jobs.detail',$value->id)}}">
                                        <i class="fas fa-eye"></i>
                                    </a>
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

<script src="{{asset('plugin/select2/select2.min.js')}}"></script>
<script src="{{asset('plugin/bootstrap-select/bootstrap-select.min.js')}}"></script>


<script>
    function edit(id, name) {
        console.log(id, name)
        $("input[name='ed-jobtype']").val(name)
        $("input[name='ed-id']").val(id)
        $("#ModalUpdate").modal('show')
    }

    function remove(id, name) {
        let row = $(`tr#${id}`);
        swal({
            title: 'ลบประเภทสินค้า',
            text: `ยืนยันการลบ${name}`,
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
                    type: 'DELETE',
                    url: `jobtype/delete/${id}`,
                    success: function(response) {
                        row.fadeOut('fast')
                    }
                });
            }
        })
    }
    $("body").on('click', "#btn-save", function(e) {
        e.preventDefault();
        let html = "";
        $.ajax({
            type: 'POST',
            url: `{{route('admin.jobtype.store')}}`,
            data: $("#insert-form").serialize(),
            success: function(response) {
                console.log(response.status);
                if (response.status) {
                    $("#ModalInsert").modal('hide')
                    setTimeout(() => {
                        location.reload()
                    }, 1000)
                }
            }
        });
    });
    $("body").on('click', "#btn-edit", function(e) {
        e.preventDefault();
        let name = $("input[name='ed-jobtype']").val();
        let id = $("input[name='ed-id']").val();
        let job = {
            name,
            id
        };
        let row = $(`tr#${id}`).find("td#name");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'PUT',
            url: `jobtype/update`,
            data: job,
            success: function(response) {
                console.log(response);
                if (response.status) {
                    row.text(response.text)
                    $("#ModalUpdate").modal('hide')
                }

            }
        });
    })
    $(document).ready(function() {
        $(".basic").select2({
            tags: true
        });

        $('#dataTable').DataTable();
        $("body").on('change', '.basic', function() {
            let tech_id = $(this).val()
            let job_id = $(this).closest('tr').attr("id")
            let data = {
                tech_id,
                job_id
            }
            let me = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: 'PUT',
                url: `{{route('admin.jobs.assignTech')}}`,
                data: data,
                success: function(response) {
                    if (response.status) {
                        me.closest('tr')
                            .find("td#td-stt > .badge")
                            .text('กำลังดำเนินการ')
                            .removeClass('bg-primary')
                            .addClass('bg-warning')
                        console.log("success");
                    }
                }
            });
        })

        $('.button-test').click(function() {
            $('#modal-container').removeAttr('class').addClass("two");
            $('body').addClass('modal-active');
            console.log("hey");
        })
    });
</script>
@endsection
@extends('templates.admin')

@section('title','ประเภทงานทั้งหมด')

@section('head')
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
    #dataTable_filter{
        display: none;
    }
    .custom-select {
        width: 39%;
    }
</style>
@endsection

@section('content')

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
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มประเภทงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <form class="user" action="{{route('admin.jobtype.store')}}" method="POST" id="insert-form">
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
    <div class="col-md-10 col-12 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold  f-thai">ประเภทงานทั้งหมด</h6>
                <button class="btn btn-light f-thai" data-toggle="modal" data-target="#ModalInsert"><i class="far fa-plus-square"></i> เพิ่มประเภทงาน</button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center">#</th>
                                <th>ประเภท</th>
                                <th>สร้างเมื่อ</th>
                                <th align="center">แก้ไข</th>
                                <th align="center">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $key => $value)
                            <tr id="{{$value->id}}">
                                <td align="center" id="index">{{$key+1}}</td>
                                <td id="name">{{$value->name}}</td>
                                <td>{{$value->formattedDate()}}</td>
                                <td align="center"><button class="btn btn-primary btn-round px-4" onclick="edit('{{$value->id}}','{{$value->name}}')"><i class="far fa-edit"></i></button></td>
                                <td align="center"><button class="btn btn-danger btn-round px-4" onclick="remove('{{$value->id}}','{{$value->name}}')"><i class="far fa-trash-alt"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- modal update-->
    <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-5">
                    <form class="user" method="POST" action="{{route('admin.jobtype.update')}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-8 mb-3 mb-sm-0">
                                <input type="hidden" name="ed_id" value="">
                                <input type="text" class="form-control form-control-user" name='ed_jobtype' id="exampleFirstName" placeholder="ประเภทงาน" required>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-user btn-block" id="btn-edit">
                                    แก้ไข
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
    <!-- modal update-->
</div>
@endsection

@section('script')
<script>
    function edit(id, name) {
        console.log(id, name)
        $("input[name='ed_jobtype']").val(name)
        $("input[name='ed_id']").val(id)
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

        $("#ModalInsert").modal('hide')
        setTimeout(() => {
            $(this).closest('form').submit();
        }, 500)
    });
    $("body").on('click', "#btn-edit", function(e) {
        e.preventDefault();
        $("#ModalUpdate").modal('hide')
        setTimeout(() => {
            $(this).closest('form').submit();
        }, 500)
        
    })
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
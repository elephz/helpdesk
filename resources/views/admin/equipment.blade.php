@extends('templates.admin')

@section('title','อุปกรณ์ทั้งหมด')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/dropimage/dropify/dropify.min.css') }}">
<link href="{{ asset('theme/dropimage/dropify/account-setting.css') }}" rel="stylesheet" type="text/css" />

<style>
    table>thead>tr>th,
    table>tbody>tr>td {
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
    }

    .dropify-wrapper .dropify-message span.file-icon {
        font-size: 24px;
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
    }

    form.user .form-control-user {
        font-size: .8rem;
        border-radius: 10rem;
        padding: 1.5rem 1rem;
        color: #000;
        font-weight: bold;
    }

    .btn-round {
        font-size: .8rem;
        border-radius: 10rem;
        padding: .75rem 1rem;
    }

    .custom-select {
        width: 39%;
    }

    .box-img {
        height: 100px;
        width: 100px;
        cursor: pointer;
    }

    .boximg2 {
        width: 100%;
        height: 250px;
        position: relative;
    }

    .boximg2 img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .table .tbody td{
        vertical-align: middle !important;
    }
</style>
@endsection

@section('content')

<!-- alert row -->
@if(Session::has('message'))
<div class="row">
    <div class="col-12">
        <div class="alert {{Session::has('alert-class')?Session::get('alert-class'):'alert-success'}} alert-dismissible fade show" role="alert">
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
    <div class="modal-dialog f-thai " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มอุปกรณ์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <form class="user" action="{{route('admin.equipment.store')}}" method="POST" id="insert-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <input type="file" id="input-file-max-fs" name="select_file" class="dropify rounded shadow" data-max-file-size="2M" accept="image/gif, image/jpeg,image/png" />
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="text" class="form-control form-control-user" name='name' id="exampleName" placeholder="ชื่อ" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <input type="number" class="form-control form-control-user" name='amount' id="exampleName2" placeholder="จำนวน" required>
                        </div>
                        <div class="col-6">
                            <input type="number" class="form-control form-control-user" name='price' id="exampleName3" placeholder="ราคา" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" id="btn-save-insert" class="btn btn-primary btn-block btn-user">บันทึก</button>
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
                <h6 class="m-0 font-weight-bold  f-thai">อุปกรณ์ทั้งหมด</h6>
                <button class="btn btn-light f-thai" data-toggle="modal" data-target="#ModalInsert"><i class="far fa-plus-square"></i> เพิ่มอุปกรณ์</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center">#</th>
                                <th align="center">ภาพ</th>
                                <th>ชื่อ</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th align="center">จัดการ</th>
                               
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach($e as $key => $item)
                            <tr id="{{$item->id}}">
                                <td align="center">{{$key+1}}</td>
                                <td align="center">
                                    <div class="box-img" onclick="showimage('{{$item->name}}','{{$item->getCover()}}')">
                                        <img src="{{$item->getCover()}}" class="w-100 shadow-sm rounded">
                                    </div>
                                </td>
                                <td>{{$item->name}}</td>
                                <td  align="right">{{number_format($item->price,2)}}</td>
                                <td  align="right" >{{$item->amount}}</td>
                                <td align="center">
                                    <button class="btn btn-primary btn-round btn-block px-4" onclick="edit({{$item}},'{{$item->getCover()}}')"><i class="far fa-edit"></i></button>
                                    <button class="btn btn-danger btn-round btn-block px-4" onclick="remove('{{$item->id}}','{{$item->name}}')"><i class="far fa-trash-alt"></i></button>
                                </td>
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
        <div class="modal-dialog f-thai " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขรายละเอียด</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-update p-3">
                    <form class="user" action="{{route('admin.equipment.update')}}" method="POST" id="insert-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id">
                        <div class="form-group row">
                            <div class="boximg2">
                                <img src="" alt="" class="shadow-sm rounded w-100">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input type="text" class="form-control form-control-user" name='name' placeholder="ชื่อ" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <input type="number" class="form-control form-control-user" name='amount' placeholder="จำนวน" required>
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control form-control-user" name='price' placeholder="ราคา" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <button type="submit" id="btn-save-edit" class="btn btn-primary btn-block btn-user">แก้ไข</button>
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
    <!-- modal update-->
    <div class="modal fade" id="ShowImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-thai" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-5">
                    <img src="" alt="" class="w-100 shadow-sm rounded ">
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
<script src="{{ asset('theme/dropimage/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('theme/dropimage/dropify/bootstrap-tagsinput.min.js') }}"></script>
<script>
    function edit(obj, img) {
        console.log(obj, img)
        const md = $(".modal-update");
        md.find("[name='id']").val(obj.id)
        md.find("[name='name']").val(obj.name)
        md.find("[name='amount']").val(obj.amount)
        md.find("[name='price']").val(obj.price)
        md.find(".boximg2 img").attr('src', img)
        md.closest(".modal").modal('show')
    }

    function showimage(name, img) {
        $("#ShowImage").find('.modal-title').text(name)
        $("#ShowImage").find('.modal-body').find('img').attr('src', img)
        $("#ShowImage").modal('show')
    }

    function remove(id, name) {
        let row = $(`tr#${id}`);
        swal({
            title: 'ลบประอุปกรณ์',
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
                    url: `equipment/delete/${id}`,
                    success: function(response) {
                        setTimeout(()=>{
                            row.fadeOut('fast')
                        },200)
                    }
                });
            }
        })
    }
    $("body").on('click', "#btn-save-insert", function(e) {
        e.preventDefault();
        
        $("#ModalInsert").modal('hide')
        setTimeout(() => {
            $(this).closest('form').submit();
        }, 500)
       
    });
    $("body").on('click', "#btn-save-edit", function(e) {
        e.preventDefault();
        $("#ModalUpdate").modal('hide')
        setTimeout(() => {
            $(this).closest('form').submit();
        }, 500)
    })
    $(document).ready(function() {
        $('#dataTable').DataTable();

        $('.dropify').dropify({
            messages: {
                'default': 'อัปโหลดรูปภาพอุปกรณ์',
                'remove': '<i class="fas fa-times"></i>',
                'replace': 'Upload or Drag n Drop'
            }
        });
    });
</script>
@endsection
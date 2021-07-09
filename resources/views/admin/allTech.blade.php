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

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .badge{
        padding: 12px 15px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-12 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold  f-thai">ผู้ใช้งานทั้งหมด</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td align="center">#</td>
                                <td>ชื่อ</td>
                                <td>สมัครเมื่อ</td>
                                <td>งานปัจจุบัน</td>
                                <td align="center">Banned</td>
                                <td align="center"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $value)
                            <tr id="{{$value->id}}">
                                <td align="center" id="index">{{$key+1}}</td>
                                <td id="name">{{$value->getFullname()}}</td>
                                <td>{{$value->formattedDate($value->created_at)}}</td>
                                <td align="center"> <span class='badge badge-pill badge-primary'> {{count($value->getTechCount)}}</span></td>
                                <td align="center">
                                    <label class="switch">
                                        <input id="checkboxinp" value="{{$value->id}}" type="checkbox" {{($value->banned == 2) ? 'checked' : '' }}>
                                        <div class="slider round"></div>
                                    </label>
                                </td>
                                <td align="center"><button class="btn btn-secondary btn-round px-4" onclick="edit('{{$value->id}}')"><i class="far fa-eye"></i></button></td>
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
                    <form class="user">
                        <div class="form-group row">
                            <div class="col-sm-8 mb-3 mb-sm-0">
                                <input type="hidden" name="ed-id" value="">
                                <input type="text" class="form-control form-control-user" name='ed-jobtype' id="exampleFirstName" placeholder="ประเภทงาน" required>
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
    $(document).ready(function() {
        $('#dataTable').DataTable();

        $("body").on("change", ".switch", function() {
            let val = $(this).find('input').val();
            let data = {'data':val}
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: 'PUT',
                url: `{{route('admin.putBanned')}}`,
                data:data,
                success: function(response) {
                    if (response.status) {
                        
                    }
                }
            });
        })

    });
</script>
@endsection
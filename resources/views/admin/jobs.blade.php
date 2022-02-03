@extends('templates.admin')

@section('title','จัดการงานแจ้งปัญหา')

@section('head')
<link rel="stylesheet" href="{{asset('plugin/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugin/bootstrap-select/bootstrap-select.min.css')}}">
<link href="{{ asset('css/modalSix.css') }}" rel="stylesheet">
<link href="{{ asset('css/loader.css') }}" rel="stylesheet">


<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<style>
    table>thead>tr>th,
    table>tbody>tr>td,
    .jobinfo li span {
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
    }

    .jobinfo li span.title {
        color: #ff5938;

    }

    .jobinfo li span.detial {
        padding-left: 15px;
        text-align: left;
    }

    .btn-round {
        font-size: .8rem;
        border-radius: 10rem;
        padding: .75rem 1rem;
    }

    #dataTable_filter {
        display: none;
    }

    .card-body #dataTable_filter {
        display: block;
    }

    .custom-select {
        width: 39%;
    }

    #td-stt .badge {
        font-size: 90%;
        width: 170px;
    }

    .borderless td,
    .borderless th {
        border: none;
    }

    .dataTables_filter label ,.select2-content label {
        display: flex;
        justify-content: space-between;
        width: 100%;
        align-items: center;
    }

    .dataTables_filter label input {
        margin-left: 10px;
        padding: 1.25rem;
        border-radius: 5px;
    }

    li.border-0:not(:last-child) {
        border-bottom: 1px solid #e3e6f0 !important;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    #tname {
        font-size: 24px;
        font-weight: bold;
        text-align: right;
        width: 100%;
    }

    .al-msg {
        width: 100%;
        text-align: right;
        color: #D8000C;
        background-color: #FFBABA;
        padding: 15px;
        opacity: 0;
        transition: 0.3s;
        border-radius: 5px;
        margin-top: 10px;
    }

    button.btn-grid {
        display: grid;
        grid-template-columns: 30px 1fr;
        grid-column-gap: 5px;

        align-items: center;
    }

    .bootstrap-select.btn-group>.dropdown-toggle {
        margin-bottom: 0px !important;
    }

    #horz-list ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
        text-align: center;
    }

    #horz-list ul li {
        display: inline;
    }

    #horz-list ul li a {
        text-decoration: none;
        padding: 0.2em 1.1em;
        border: none;
        margin: 0 0 5px -6px;
        border-radius: 5px;
        color: #000;
        transition: 0.3s;

    }


    #horz-list ul li a:hover , .a-active  {
        background: #2c3e50;
        color: #fff !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered , .select2-results__option {
        font-family: 'Kanit', sans-serif !important;
        letter-spacing: 2px;
        font-weight: bold;
    }
    a.disabled {
        pointer-events: none;
        cursor: default;
    }

</style>
@endsection
@section('modal')
<div id="modal-container">
    <div class="modal-background">

        <div class="modal">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <span class="f-thai">มอบหมายงาน</span>
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
                                            @foreach($tech as $key => $item)
                                            <tr>
                                                <td align="center" id="index">{{$key+1}}</td>
                                                <td class="text-left">{{$item->getFullname()}}</td>
                                                <td>{{count($item->getTechCount)}}</td>
                                                <td>
                                                    <button class="btn btn-success" onclick='selectT("{{$item->getFullname()}}","{{$item->id}}")'>
                                                        <i class="far fa-arrow-alt-circle-right"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="f-thai text-left">รายละเอียดงาน</p>
                        <ul class="list-group border-0 jobinfo">
                            <li class="list-group-item d-flex flex-column  align-items-start border-0">
                                <span class='title'>ประเภทงาน</span>
                                <span class='detial' id='jobtype'></span>
                            </li>
                            <li class="list-group-item d-flex flex-column  align-items-start border-0">
                                <span class='title'>รายละเอียด</span>
                                <span class='detial' id='detail'></span>
                            </li>
                            <li class="list-group-item d-flex flex-row  align-items-start border-0 pb-4">
                                <span class='title text-left w-100'>ค่าแรง</span>
                                <input type="number" name="amount" class="form-control text-right" value="0" min="0">
                            </li>
                            <li class="list-group-item d-flex flex-column  align-items-start border-0">
                                <span class='badge badge-pill badge-primary px-3 py-2'>ช่างเทคนิค</span>
                                <span class='detial' id='tname'>
                                    <i class="fas fa-question"></i>
                                </span>
                            </li>
                            
                            <input type="hidden" name='job_id'>
                            <input type="hidden" name='t_id'>
                            <li class="list-group-item d-flex flex-column  align-items-start border-0">
                                <button class="btn btn-info btn-block rounded-pill" onclick="save()" style="position: relative;">
                                    <span class='save-text'> บันทึก </span>
                                    <div class="container-loader">
                                        <div class="loader">
                                            <div class="circle" id="a"></div>
                                            <div class="circle" id="b"></div>
                                            <div class="circle" id="c"></div>
                                        </div>
                                    </div>
                                </button>
                                <span class='al-msg shadow-sm'>
                                    <i class="fas fa-exclamation-circle"></i> 
                                    <span id="err-msg"></span> 
                                </span>
                            </li>
                        </ul>
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
                                <th>ใบเสร็จ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $key => $value)
                            <tr id="{{$value->id}}">
                                <td align="center" id="index">{{$value->JobId}}</td>
                                <td>{{$value->JobType->name}}</td>
                                <td>{{$value->formattedDate_time()[0]}} <br> <span style="font-size: 12px;">{{$value->formattedDate_time()[1]}}</span></td>
                                <td>{{$value->getUser->name}}</td>
                                <!-- <td>{{$value->JobStatus()}}</td> -->
                                <td class='text-center' id="td-stt">
                                    <span class='badge {{$value->StatusColor()}} text-white py-2 px-3 '>{{$value->JobStatus()}}</span>
                                </td>
                                <td>
                                    @if($value->jobStatus == 1)
                                    <button class="btn btn-primary btn-block button-test" onclick="customModal({{$value}},'{{$value->JobStatus()}}')">
                                        <i class="far fa-plus-square"></i>
                                    </button>
                                    @elseif($value->jobStatus == 2)
                                    <button class="btn btn-success btn-block button-test btn-grid" onclick="customModal({{$value}},'{{$value->JobStatus()}}',{{$value->getTech}})">
                                        <i class="fas fa-user-edit"></i>
                                        <span class="text-left w-100"> {{$value->getTech->getFullname() ?? ""}} </span>
                                    </button>
                                    @elseif($value->jobStatus == 4)
                                    <div class="d-flex">
                                        <button class="btn btn-success  w-75 button-test btn-grid mr-2">
                                            <i class="fas fa-check"></i>
                                            <span class="text-left w-100"> {{$value->getTech->getFullname() ?? ""}} </span>
                                        </button>
                                        <button class="btn btn-primary w-25 button-test ml-2" onclick="customModal({{$value}},'{{$value->JobStatus()}}')">
                                            <i class="far fa-plus-square"></i>
                                        </button>
                                    </div>
                                    @else
                                    <button class="btn btn-success  btn-block button-test btn-grid">
                                        <i class="fas fa-check"></i>
                                        <span class="text-left w-100"> {{$value->getTech->getFullname() ?? ""}} </span>
                                    </button>
                                    @endif
                                </td>
                                <td align="center">
                                    <a class="btn {{$value->jobStatus == '3' ? 'btn-primary' : 'btn-default disabled'}} " href="{{route('pdf',$value->id)}}" target="_bank"   >
                                        <i class="far fa-file-alt"></i>
                                    </a>
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

<script>
    function selectT(name, id) {
        $(".jobinfo #tname").text(name)
        $(".jobinfo input[name='t_id']").val(id)
    }
    const tech = @json($tech);
    console.log(tech);
    function customModal(obj, status, tech = null) {
        if (tech) {
            $(".jobinfo #tname").text(tech.name + " " + tech.lastname)
            $(".jobinfo input[name='t_id']").val(tech.id)
        } else {
            $(".jobinfo #tname").html('<i class="fas fa-question"></i>')
        }
        $(".jobinfo #jobtype").text(obj.job_type.name)
        $(".jobinfo #detail").text(obj.caseDetail)
        $(".jobinfo #address").text(obj.address)
        $(".jobinfo #name").text(obj.get_user.name + " " + obj.get_user.lastname)
        $(".jobinfo #phone").text(obj.get_user.phone)
        $(".jobinfo #status").text(status)
        $(".jobinfo input[name='job_id']").val(obj.id)
        $('#modal-container').removeAttr('class').addClass("two");
        $('body').addClass('modal-active');
    }

    function save() {
        const techid = $(".jobinfo input[name='t_id']").val()
        const jobsid = $(".jobinfo input[name='job_id']").val()
        const amount = +($(".jobinfo input[name='amount']").val())

        if (!techid || !jobsid ) {
            $("#err-msg").text("กรุณาเลือกช่างเทคนิค !!!")
            $("span.al-msg").css('opacity', '1')
            setTimeout(() => {
                $("span.al-msg").css('opacity', '0')
            }, 3000)
            return
        }
        if(amount < 1) {
            $("#err-msg").text("จำนวนค่าแรงต้องไม่ติดลบ !!!")
            $("span.al-msg").css('opacity', '1')
            setTimeout(() => {
                $("span.al-msg").css('opacity', '0')
            }, 3000)
            return
        }
        $(".save-text").css('opacity', 0)
        $(".loader").css('opacity', 1)
        let data = {
            techid,
            jobsid,
            amount
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'PUT',
            url: `jobs/assignTech`,
            data: data,
            success: function(response) {
                if (response.status) {
                    setTimeout(() => {
                        $("#modal-container .modal-background .modal .modal-header i").click()
                    }, 1000)
                    setTimeout(() => {
                        location.reload();
                    }, 1100)
                } else {
                    console.log("error");
                }
            }
        });
    }
    $(document).ready(function() {

        $('#dataTable').DataTable({
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>>" +
                "<'row'<'col-9 ct-fillter d-flex py-2'> <'col-3  select2-content'> >" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-12'p>>",
            "order": []

        });
        let text = `<div id="horz-list" class='pt-2 pl-3'>
            <ul>
                <li><a href="" class='f-thai 1 a-active' onclick=filter('',event,1) >ทั้งหมด</a></li>
                <li><a href="" class='f-thai 2' onclick=filter('งานใหม่',event,2) >งานใหม่</a></li>
                <li><a href="" class='f-thai 3' onclick=filter('กำลังดำเนินการ',event,3) >กำลังดำเนินการ</a></li>
                <li><a href="" class='f-thai 4' onclick=filter('เสร็จสิ้น',event,4) >เสร็จสิ้น</a></li>
                <li><a href="" class='f-thai 5' onclick=filter('ยกเลิก',event,5) >ยกเลิก</a></li>
            </ul>
        </div>`
        $(".ct-fillter").html(text);
        let allTech = "";
        tech.forEach(element => {
            allTech +=`<option value="${element.name+" "+element.lastname} " class='f-thai' >${element.name} ${element.lastname}</option>`;
        });
        const select2 = ` <label>
                                <div class='w-50 text-right mr-2 mb-4 f-thai'>ช่างเทคนิค : </div>
                                <select class="form-control basic f-thai">
                                    <option value="" class='f-thai' >ทั้งหมด</option>
                                    ${allTech}
                                </select>
                            </label>`;
        $(".select2-content").html(select2)

        $(".basic").select2({
            tags: true
        });

        $("select.basic").change(function(){
            const val = $(this).val();
            var table = $('#dataTable').DataTable();
            table.columns([5])
                .search(val)
                .draw();
        })

        $('#dataTable2').DataTable({
            "pageLength": 6,
            "lengthChange": false,
            "dom": "<'row'<'col-md-6'f><'col-md-6'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-12'p>>",
            
        });
        $("body").on('change', '.basic', function() {
            let tech_id = $(this).val()
            let job_id = $(this).closest('tr').attr("id")
            let data = {
                tech_id,
                job_id
            }
            let me = $(this);

        })


    });
    
    function filter(val, e,me) {
        e.preventDefault()
       
        $("#horz-list ul li a").removeClass('a-active')
        $("#horz-list ul li a."+me).addClass('a-active')
        var table = $('#dataTable').DataTable();
        table.columns([4])
            .search(val)
            .draw();
    }

    
</script>
@endsection
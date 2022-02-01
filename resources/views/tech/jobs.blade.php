@extends('templates.tech')

@section('title','Dashboard')

@section('head')
<link href="{{ asset('css/modalSix.css') }}" rel="stylesheet">
<link href="{{ asset('css/loader.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">

<style>
    #btn {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;

    }

    .amount-price {
        display: grid;
        grid-template-columns: 1fr 100px;
        grid-gap: 10px;
        align-items: center;
    }

    .modal-body {
        position: relative;
        min-height: 600px;
    }

    .top-right {
        position: absolute;
        top: 0px;
        right: 0px;
        font-size: 12px;
    }

    .box-img {
        height: 100px;
        width: 100px;
        cursor: pointer;
    }

    .modal-body .table td,
    .table th {
        vertical-align: middle;
    }

    .box-img img {
        width: 100%;
        object-fit: cover;
    }

    #modal-container .modal-background .modal .modal-body {
        padding: 25px;
    }

    .list-item {
        overflow: auto;
        height: 500px !important;
    }

    .list-item ul {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 10px;
        grid-row-gap: 10px;

    }

    .list-item ul li {
        display: grid;
        grid-template-columns: 100px 1fr;
        grid-column-gap: 10px;
        align-items: center;
        position: relative;
    }

    .list-item ul li .content .name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #444;
    }

    .list-item ul li a {
        transition: 0.3s;
        font-size: 24px;
        cursor: pointer;
        position: absolute;
        top: -17px;
        right: -14px;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 5px;
    }

    

    textarea {
        resize: none;
    }

    .bootstrap-touchspin {
        width: 50% !important;
        text-align: center;
    }

    #touch i {
        color: #fff;
        background-color: #2c3e50;
        transition: 0.3s;
        cursor: pointer;
    }

    #touch i:hover {
        color: #2c3e50;
        background-color: #fff;
        transform: scale(1.3);
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    input[type=number]:focus {
        outline: none !important;
    }

    input[type=number] {
        font-size: 18px;
        font-weight: bold;
    }
    input#techwage{
        font-size: 16px !important;
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
                    <div class="col-5">
                        <div class="shadow-sm rounded p-4">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table borderless h-100" id="dataTable2" width="100%" cellspacing="0">
                                        <thead class="bg-light text-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>รูปภาพ</th>
                                                <th>ชื่อ</th>
                                                <th>คงเหลือ</th>
                                                <th>ราคา</th>
                                                <th>เลือก</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($hw as $key => $item)
                                            <tr>
                                                <td>{{$item->JobId}}</td>
                                                <td align="center">
                                                    <div class="box-img">
                                                        <img src="{{$item->getCover()}}" class="w-100 shadow-sm rounded">
                                                    </div>
                                                </td>
                                                <td>{{$item->name}}</td>
                                                <td align="right">{{$item->amount}}</td>
                                                <td align="right">{{number_format($item->price,2)}}</td>
                                                <td>
                                                    <button class="btn btn-success" onclick="obj.addItem({{$item}},'{{$item->getCover()}}')">
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
                    <div class="col-7">
                        <form action="{{route('tech.Jobs.success')}}" method="POSt" class="f-thai w-100 text-left d-flex flex-column justify-content-between h-100">
                            @csrf
                            <input type="hidden" name='job_id'>
                            <div class="form-group d-flex justify-content-between">
                                <div class="w-100">
                                    <p class="text-dark">รายละเอียด</p>
                                    <textarea name="detail" id="email" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="text-left w-100  ml-3">
                                    <p class="text-dark">รวมค่าใช้จ่าย</p>
                                    <ul class="list-group border-0">
                                        <li class="list-group-item d-flex justify-content-between  border-0">
                                            <span>ค่าแรง</span>
                                            <span id='wage'>0</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between  border-0">
                                            <span>บวกเพิ่มจากช่าง</span>
                                            <input type="number" name="tech_wage" id="tech-wage" class='form-control w-25 border-0 text-right p-0' value="0">
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between  border-0">
                                            <span>ค่าอุปกรณ์</span>
                                            <span id='hard-ward'>0</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between  border-0">
                                            <span>รวมทั้งสิ้น</span>
                                            <span id="total">0</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="list-item h-100 border p-3">
                                <p class="text-dark">รายละเอียดการใช้อุปกรณ์</p>
                                <ul class="list-group">
                                    
                                </ul>
                            </div>
                            <button id="btn-save" class="btn btn-primary btn-block mt-2">บันทึก</button>
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
                <div class="table-responsive">
                    <table class="table table-bordered f-thai" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
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
                                <td align="center" id="index">{{$value->JobId}}</td>
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
                                    <button class="btn btn-success" title="ดำเนินการเสร็จสิ้น" onclick="successJob({{$value}})">
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
                                    <a href="{{route('pdf',$value->id)}}" class="btn btn-secondary" target="_bank" title="ใบเสร็จ">
                                        <i class="far fa-file-alt"></i>
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
<script src="{{asset('plugin/touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('plugin/touchspin/custom-bootstrap-touchspin.js')}}"></script>
<script>
    $(function() {
        $('button').tooltip();
        $("#btn-save").click(function() {
            $(".two").addClass('out');
            $('body').removeClass('modal-active');
            const form = $(this).closest('form')
            setTimeout(() => {
                form.submit()
            }, 1000)
        })

        $('#dataTable2').DataTable({
            "pageLength": 4,
            "lengthChange": false,
            "dom": "<'row'<'col-md-12 text-left'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-12'p>>",
        });

        $("#modal-container .modal-background .modal .modal-header i").click(() => {
            console.log("hey");
            $(".two").addClass('out');
            $('body').removeClass('modal-active');

        })

    });
    var obj = {
        wage: 0,
        hardward: 0,
        techwage:0,
        arr: [],
        addItem: function(obj, img) {
            console.log();
            let incard = false;

            for (let i = 0; i < this.arr.length; i++) {
                if (this.arr[i].id == obj.id) {
                    incard = true;
                    if(this.arr[i].amount >= this.arr[i].total){
                        return
                    }
                    this.arr[i].amount++;
                    break;
                }
            }

            if (!incard) {
                this.arr.push({
                    'id': obj.id,
                    'name': obj.name,
                    'img': img,
                    'amount': 1,
                    'price': obj.price,
                    'total':obj.amount
                })
            }

            this.write();
        },
        minus: function(id) {
            for (let i = 0; i < this.arr.length; i++) {
                if (this.arr[i].id == id) {

                    this.arr[i].amount--;

                    if (this.arr[i].amount <= 0) {
                        this.arr.splice(i, 1)
                        return;
                    }

                    break;
                }
            }
            this.write()
        },
        plush: function(id) {
            console.log("plush id = " + id);
            for (let i = 0; i < this.arr.length; i++) {
                if (this.arr[i].id == id) {
                    if(this.arr[i].amount >= this.arr[i].total){
                        return
                    }
                    this.arr[i].amount++;
                    console.log("here", this.arr[i]);
                    break;
                }
            }
            this.write();
        },
        delete: function(id) {
            for (let i = 0; i < this.arr.length; i++) {
                if (this.arr[i].id == id) {
                    this.arr.splice(i, 1)
                    break;
                }
            }

            this.write();
        },
        write: function() {
            let text = "";
          
            this.arr.forEach((item) => {
                text +=
                    `
                <li class="list-group-item p-3 shadow-sm rounded">
                    <img src="${item.img}" alt="" class="w-100">
                    <div class="content">
                        <p class="name">${item.name}</p>
                        <div class="amount-price" data="${item.id}">
                            <div class="d-flex justify-content-between align-items-center mr-3 text-center" id='touch'>
                                <i class="fas fa-minus shadow-sm p-2 rounded-circle" onclick="obj.minus('${item.id}')"></i>
                                    <input type="hidden" name="product[]" value="${item.id}" >
                                    <input type="number" name="amount[]" value="${item.amount}" class="form-control rounded border-0 w-25 text-dark">
                                <i class="fas fa-plus shadow-sm p-2 rounded-circle" onclick="obj.plush('${item.id}')"></i>
                            </div>
                            <span id='total'> <h5> <b> ${item.amount * item.price} </b> </h5></span>
                        </div>
                    </div>
                    <a class="text-danger p-2 shadow-sm rounded-circle bg-white" >
                        <i class="fas fa-times" onclick="obj.delete('${item.id}')"></i>
                    </a>
                </li>
            `;
            })
            this.calculate();

            $(".list-item ul").empty().html(text);

        },
        calculate: function() {
            let count = 0;
            for (let i = 0; i < this.arr.length; i++) {
                count += this.arr[i].price * this.arr[i].amount
            }
            this.hardward = count
            $("ul.list-group li #wage").text(number_format(this.wage))
            $("ul.list-group li #hard-ward").text(number_format(this.hardward))
            $("ul.list-group li #total").text(number_format(+(this.hardward) + +(this.wage) + +(this.techwage)))

        }

    }

    $("input#tech-wage").change(function(){
        obj.techwage = $(this).val()
        obj.calculate()
    })
    function number_format(number){
        return Intl.NumberFormat('th-TH', {
                style: 'currency',
                currency: 'THB',
            }).format(number)
    }
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

    function successJob(val) {

        $('#modal-container').removeAttr('class').addClass("two");
        $('body').addClass('modal-active');
        $("ul.list-group li #wage").text(val.wage)
        this.obj.wage = val.wage
        $("form").find("input[name='job_id']").val(val.id)
        return
        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //     },
        //     type: 'PUT',
        //     url: `Jobs/success/${id}`,
        //     cache: false,
        //     success: function(response) {
        //         console.log(response);
        //         if (response.status) {
        //             Cttoas('success', 'บันทึกสำเร็จ')
        //             setTimeout(() => {
        //                 location.reload();
        //             }, 500)
        //         } else {
        //             if (response.type == 'activedted') {
        //                 Cttoas('error', 'เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง')
        //             } else {
        //                 console.log('error');
        //             }
        //         }

        //     },
        //     error: function(e) {
        //         console.log(e)
        //     }
        // });
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
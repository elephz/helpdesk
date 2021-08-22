@extends('templates.tech')

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
        font-weight: bold;
    }

    table>thead>tr>th {
        text-align: center;
    }

    li .info-list-text {
        color: #888ea8;
    }

    .list-group-item {
        display: grid;
        grid-template-columns: 100px 1fr;
        grid-gap: 10px;
        border: unset;
        border-radius: 15px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
    }

    .flist {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
    }

    .flist .list-group-item {
        height: 155px;
    }

    .tlist {
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 10px;
    }
    h1{
        font-size: 4.5rem;
    }
    .tlist .list-group-item {
        min-height: 175px;
    }
    h1 i{
        color: #2c3e50;
    }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 f-thai">รายละเอียด</h1>
</div>
<div class="row">
    <div class="col-md-5 col-12">
        <div class="row">
            <img src="{{$jobs->getImg()}}" alt="" class='w-100 shadow rounded'>
        </div>
        <div class="row mt-5">
            <div class="col-12 mx-auto">
                <h1 class="h3  text-gray-800 f-thai">แผนที่</h1>
                <iframe width="100%" height="500" class='shadow rounded' src="https://maps.google.com/maps?q={{$jobs->Latitude}},{{$jobs->Longitude}}&output=embed"></iframe>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-12">
        <ul class='list-group flist'>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fas fa-cog"></i>

                </h1>
                <div>
                    <span class='info-list-title'>ประเภทงาน</span>
                    <span class='info-list-text'>{{$jobs->JobType->name}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="far fa-address-book"></i>
                </h1>
                <div>
                    <span class='info-list-title'>ชื่อ</span>
                    <span class='info-list-text'>{{$jobs->getUser->name}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fas fa-phone-square"></i>
                </h1>
                <div>
                    <span class='info-list-title'>โทรศัพท์</span>
                    <span class='info-list-text'>{{$jobs->getUser->phone}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fas fa-user-cog"></i>
                </h1>
                <div>
                    @if($jobs->jobStatus == '1')
                    <button class="btn btn-primary btn-block" onclick="acceptJob('{{$jobs->id}}')">
                        รับงาน
                    </button>
                    @else
                    <span class='info-list-title'>ผู้รับงาน</span>
                    <span class='info-list-text'>{{$jobs->getTech->name}}</span>
                    @endif
                </div>
            </li>
        </ul>
        <ul class='list-group tlist mt-4'>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fab fa-linkedin"></i>
                </h1>
                <div>
                    <span class='info-list-title'>รายละเอียด</span>
                    <span class='info-list-text'>{{$jobs->caseDetail}}</span>
                </div>
            </li>
            <li class="list-group-item list-group-item-action ">
                <h1>
                    <i class="fas fa-map-marked-alt"></i>
                </h1>
                <div>
                    <span class='info-list-title'>ที่อยู่</span>
                    <span class='info-list-text'>{{$jobs->address}}</span>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="row my-4">

</div>
@endsection

@section('script')


<script>
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
                    url: `/tech/Jobs/${id}`,
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
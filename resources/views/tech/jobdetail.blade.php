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
    }

    table>thead>tr>th {
        text-align: center;
    }

    li .info-list-text {
        color: #888ea8;
    }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 f-thai">รายละเอียด</h1>
</div>
<div class="row">
    <div class="col-md-5 col-12">
        <img src="{{$jobs->getImg()}}" alt="" class='w-100 shadow rounded'>
    </div>
    <div class="col-md-7 col-12">
        <ul class='list-unstyled mt-3'>
            <li>
                <span class='info-list-title'>ประเภทงาน</span>
                <span class='info-list-text'>{{$jobs->JobType->name}}</span>
            </li>
            <li>
                <span class='info-list-title'>รายละเอียด</span>
                <span class='info-list-text'>{{$jobs->caseDetail}}</span>
            </li>
            <li>
                <span class='info-list-title'>ที่อยู่</span>
                <span class='info-list-text'>{{$jobs->address}}</span>
            </li>
            <li>
                <span class='info-list-title'>ชื่อ</span>
                <span class='info-list-text'>{{$jobs->getUser->name}}</span>
            </li>
            <li>
                <span class='info-list-title'>โทรศัพท์</span>
                <span class='info-list-text'>{{$jobs->getUser->phone}}</span>
            </li>
            <li>
                @if($jobs->jobStatus == '1')
                <button class="btn btn-primary btn-block" onclick="acceptJob('{{$jobs->id}}')">
                    รับงาน
                </button>
                @else
                <span class='info-list-title'>ผู้รับงาน</span>
                <span class='info-list-text'>{{$jobs->getTech->name}}</span>
                @endif
            </li>
        </ul>

    </div>
</div>
<div class="row my-4">
    <div class="col-md-10 col-12 mx-auto">
        <iframe width="100%" height="500" src="https://maps.google.com/maps?q={{$jobs->Latitude}},{{$jobs->Longitude}}&output=embed"></iframe>
    </div>
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
                           setTimeout(()=>{
                            location.reload();
                           },500)
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
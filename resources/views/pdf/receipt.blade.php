<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        html,
        body {
            width: 210mm;
            height: 297mm;
            font-family: "THSarabunNew";
            font-size: 18px;
            line-height: 1;
        }

        .f24 {
            font-size: 24px;
        }

        .fb {
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }


        .thead-left {
            width: 20mm;
            border-right: 1px solid black;
            padding: 10px;
            border-bottom: 1px solid black;
        }

        .thead-right {
            width: 66mm;
            text-align: right;
            border-bottom: 1px solid black;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .thead-center {
            height: 20mm;
        }

        .flex-container {
            margin: auto;
            display: table;
            width: 98%;
        }

        .d-table {
            display: table;
        }

        .d-item {
            display: table-cell;
        }

        .flex-item {
            text-align: center;
            display: table-cell;
            width: 50%;
        }

        .flex-item-invoice {
            display: table-cell;
            padding: 5px 15px;
        }

        .flex-item table {
            margin: 15px;
            border: 1px solid black;
        }

        .mt-2 {
            padding-top: 20px;
        }

        .flex-item table tr td {
            padding: 10px;
        }
        .product-list{
            width: 94%;
            margin-left: 5px;
            /* margin: 5px 15px 5px 15px; */
        }
        .product-list table:first-child {
            margin: 2px 15px 0px 15px;
        }

        .product-list table thead tr th {
            border-bottom: 1px solid #b0aeae;
            padding-bottom: 5px;
        }

        .product-list table tbody tr td {
            border-bottom: 1px solid #e6e6e6;
            vertical-align: middle;
            padding: 3px 0px;
        }

        .pm-0 {
            padding: 0;
            margin: 0;
            padding-left: 15px;
            line-height: .8;
        }

        .pl-3 {
            padding-left: 15px;
        }

        .pr-3 {
            padding-right: 15px;
        }

        .ftable table tbody tr.border-none td {
            border: none !important;
        }

        .ftable table tbody tr.border-none td.border {
            border-top: 1px solid black !important;
            border-bottom: 3px solid balck !important;
        }

        .ftable {
            page-break-inside: avoid;
            width: 40%;
            margin-left: auto;
            margin-right: 12px;
        }

        .ftable table {
            margin-top: 0px;
        }
    </style>
</head>

<body>

    <div class="flex-container">
        <div class="flex-item-invoice">
            <div class="flex-container text-center">
                <span class="f24 "> <b> ใบเสร็จรับเงิน </b></span>
            </div>
            <div class="flex-container" style="margin-bottom: 10px;">
                <div class="d-item" style="text-align: left;width:40%">
                    {{$job->getUser->getFullname()}} <br>
                    {{$job->getUser->address}} <br>
                    เบอร์โทร : {{$job->getUser->phone}}
                </div>
                <div class="d-item" style="text-align: left;width:20%">
                </div>
                <div class="d-item" style="text-align: left;width:40%">
                    บริษัท YNK HelpDesk  <br>
                    67/5 ต.แม่สาย อ.แม่สาย จ.เชียงราย <br>
                    <div class="d-table">
                        <div class="flex-item" style="text-align: left;">
                            อีเมล : yanakorn@gmail.com
                        </div>
                        <div class="flex-item" style="text-align: left;">
                            เบอร์โทร : 098-998-3876
                        </div>
                    </div>

                </div>
            </div>
            <div class="flex-container" style=" border-bottom: 2px solid black;padding-bottom:3px">
                <div class="d-item" style="text-align: left;width:50%">
                    <span>รายการแจ้งซ่อม : {{$job->JobId}} <b></b></span>
                </div>
                <div class="d-item" style="text-align: right;width:50%">
                    <span>วันที่ : {{$today}} </span>
                </div>
            </div>

        </div>

    </div>
    
    <div class="product-list"  >
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 10%;">ลำดับ</th>
                    <th class="text-left pl-3" style="width: 40%;">สินค้า</th>
                    <th class="text-right" style="width: 20%;">ราคาต่อหน่วย</th>
                    <th class="text-right" style="width: 10%;">จำนวน</th>
                    <th class="text-right pr-3" style="width: 25%;">
                        รวม
                    </th>
                </tr>
            </thead>
            <tbody>
                @if(count($job->Equipment()) > 0)
                    @foreach($job->Equipment() as $key => $value)
                    <tr>
                        <td class="text-center" >{{$key+1}}</td>
                        <td class="text-left" >{{$value->equipment->name}}</td>
                        <td class="text-right" >{{number_format($value->equipment->price,2)}}</td>
                        <td class="text-right" >{{$value->amount}}</td>
                        <td class="text-right" >{{number_format($value->equipment->price * $value->amount,2)}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
        
    </div>
    <div class="ftable">
            <table>
                <tbody>
                    <tr class="border-none " >
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-left">รวมค่าอุปกรณ์</td>
                        <td class="text-right"">
                        <span class=" pr-3">
                        {{number_format($job->HardwareReport->total,2)}}
                            </span>
                        </td>
                    </tr>

                    <tr class="border-none " >
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-left">ค่าแรง</td>
                        <td class="text-right"">
                        <span class=" pr-3">
                        {{number_format($job->wage,2)}}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-none ">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-left">ค่าแรงจากช่าง</td>
                        <td class="text-right"">
                        <span class=" pr-3">
                        {{number_format($job->tech_wage,2)}}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-none ">
                        <td></td>
                        <td></td>
                        <td class="border"></td>
                        <td class="text-left f24 border"> <b> รวมทั้งสิ้น </b></td>
                        <td class="text-right f24 border">
                            <span class="pr-3">
                                <b>{{number_format($job->HardwareReport->ordertotal,2)}}</b>
                            </span>
                        </td>
                    </tr>
                    <tr class="border-none ">
                        <td></td>
                        <td></td>
                        <td class="border-top"></td>
                        <td class="border-top"></td>
                        <td class="border-top"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    

</body>


</html>
<?php

namespace App\Http\Controllers;

use App\JobCase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class ReceiptController extends Controller
{
    public function index($id)
    {
        $job = JobCase::findOrFail($id);
        if($job->jobStatus != 3) {
            return redirect()->back();
        }
        $data = [
            'job'=>$job,
            'today'=> Carbon::now()->format('d/m/Y H:i')
        ];
        $pdf = PDF::loadview('pdf.receipt',$data);
        return $pdf->stream();
    }
}

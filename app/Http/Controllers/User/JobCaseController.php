<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\JobCase;
use DB;
use LineNotify;

class JobCaseController extends Controller
{
    public function store(Request $request)
    {
        // return response()->json(["status" => true,]);
        $access_token = 'cNyi7YfMJhJub0XZvF5Dg5NamvgDazofIjZSWiaA48A';
        try {
            $job = new JobCase;
            $user_id = Auth::user()->id;
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $job->caseTypeId = $request->select;
            $job->userId = $user_id;
            $job->image = $new_name;
            $job->Latitude = $request->Latitude;
            $job->Longitude = $request->Longitude;
            $job->caseDetail = $request->detail;
            $job->address =  $request->address;
            $job->save();
            DB::commit();
            LineNotify::sendMessage($access_token, $job->getUser->name." ได้เพิ่มงานแจ้งซ่อมประเภท".$job->JobType->name);
            return response()->json(["status" => true,]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false]);
        }
       
    }
}

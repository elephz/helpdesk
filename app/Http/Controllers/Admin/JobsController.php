<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CaseType;
use DB;
use App\JobCase;
use Carbon\Carbon;
use App\User;
class JobsController extends Controller
{
    public function index()
    {
        $job = JobCase::orderBy('id','desc')->get();
        $tech = User::where('roleid','2')->where('acceptTeach','2')->get();
        return view('admin.jobs')->with(['jobs' => $job,'tech' => $tech]);
    }

    public function detail($id)
    {
        $job = JobCase::where('id',$id)->first();
        return view('admin.jobdetail')->with(['jobs' => $job]);
    }

    public function assignTech(Request $request)
    {
        // return response()->json(["status" => true]);
        try {
            $job = JobCase::where('id',$request->jobsid)->first();
            $job->techId = $request->techid;
            $job->jobStatus = 2;
            $job->assginTime = Carbon::now();
            $job->save();
            DB::commit();
            return response()->json(["status" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false]);
        }
       
    }
}

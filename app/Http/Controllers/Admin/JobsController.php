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
        $tech = User::where('roleid','2')->where('acceptTeach','2')->orderBy('created_at','desc')->get();
        return view('admin.jobs')->with(['jobs' => $job,'tech' => $tech]);
    }

    public function detail($id)
    {
        $job = JobCase::where('id',$id)->first();
        return view('admin.jobdetail')->with(['jobs' => $job]);
    }

    public function assignTech(Request $request)
    {
      
        try {
            $job = JobCase::where('id',$request->jobsid)->first();
            $job->techId = $request->techid;
            $job->wage = $request->amount;
            $job->assginTime = Carbon::now();
            $job->update();
            DB::commit();
            return response()->json(["status" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false,'msg'=>$e->getMessage()]);
        }
       
    }
}

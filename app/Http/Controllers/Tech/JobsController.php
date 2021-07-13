<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobCase;
use App\Equipment;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class JobsController extends Controller
{
    public function index()
    {
        $Userid = Auth::id();
        $job = JobCase::where('techId', $Userid)->orderBy('updated_at','desc')->get();

        return view('tech.jobs')->with([
            'jobs' => $job,
            'hw' => Equipment::all()
            ]);
    }

    

    public function getSuccessReport($id)
    {
        $job = JobCase::where('id', $id)->first();
        return view("tech.success")->with(['job'=>$job]);
    }
    public function accept($id)
    {
        $job = JobCase::where('id', $id)->first();
        $Userid = Auth::id();
        if ($job->jobStatus != '1') {
            return response()->json(["status" => false, "type" => "activedted"]);
        } else {
            try {
                $job->jobStatus = '2';
                $job->acceptTime = Carbon::now();
                $job->techId = $Userid;
                $job->save();
                DB::commit();
                return response()->json(["status" => true,]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["status" => false,"type" => 'error']);
            }
        }
    }

    public function detail($id)
    {
        $job = JobCase::where('id',$id)->first();
        
        return view('tech.jobdetail')->with(['jobs' => $job]);
    }
    public function getCancelMsg($id) 
    {
        $job = JobCase::where('id', $id)->first();
        return response()->json(["status" => true,"msg"=>$job->note,'time'=>$job->formattedDate($job->cancelTime)]);
    }
    public function success($id)
    {
        $job = JobCase::where('id', $id)->first();
        $Userid = Auth::id();
        if ($job->jobStatus != '2') {
            return response()->json(["status" => false, "type" => "activedted"]);
        } else {
            try {
                $job->jobStatus = '3';
                $job->successTime = Carbon::now();
                $job->techId = $Userid;
                $job->save();
                DB::commit();
                return response()->json(["status" => true,]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["status" => false,"type" => 'error']);
            }
        }
    }
    public function cancel(Request $request)
    {
        $job = JobCase::where('id', $request->id)->first();
        $Userid = Auth::id();
            try {
                $job->jobStatus = '4';
                $job->cancelTime = Carbon::now();
                $job->cancelBy = $Userid;
                $job->note = $request->msg;
                $job->save();
                DB::commit();
                return response()->json(["status" => true,]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["status" => false,"type" => 'error']);
            }
      
    }
}

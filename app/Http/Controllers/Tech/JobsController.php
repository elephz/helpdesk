<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobCase;
use App\Equipment;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Using_Eq;
use Session;

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
    public function success(Request $request)
    {
        // dd($request->all());
        $id = $request->job_id;
        $job = JobCase::where('id', $id)->first();
        $Userid = Auth::id();
        $product_id = $request->product;
        $amount = $request->amount;
        // dd($product_id,$amount);
        if ($job->jobStatus != '2') {
            return response()->json(["status" => false, "type" => "activedted"]);
        } else {
            try {
                $job->jobStatus = '3';
                $job->successTime = Carbon::now();
                $job->techId = $Userid;
                $job->note = $request->detail;
                $job->update();

                if(count($product_id ?? [])){
                    for($i = 0 ; $i < count($product_id); $i++){
                        $eq = new Using_Eq;
                        $eq->job_case_id = $request->job_id;
                        $eq->equipment_id = $product_id[$i];
                        $eq->amount = $amount[$i];
                        $eq->save();

                        $hw = Equipment::where('id',$product_id[$i])->first();

                        if($hw->amount < $amount[$i]){
                            Session::flash('message', 'อุปกรณ์ '.$hw->name.' จำนวนไม่เพียงพอ');
                            Session::flash('alert-class', 'alert-danger');
                            return redirect()->back();
                        }

                        $hw->amount = ($hw->amount - $amount[$i]);
                        $hw->update();
                    }
                }



                DB::commit();
                Session::flash('message', 'บันทึกสำเร็จ');
                Session::flash('alert-class', 'alert-success');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                Session::flash('message', 'บันทึกไม่สำเร็จ');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CaseType;
use DB;


class JobsTypeController extends Controller
{
    public function index()
    {
        $job = CaseType::all();
        return view('admin.jobtype')->with(['jobs' => $job]);
    }
    
    public function update(Request $request)
    {
        try {
            $job = CaseType::where('id', $request->id)->first();
            $job->name = $request->name;
            $job->save();
            DB::commit();
            return response()->json(["status" => true,"text"=>$job->name]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false]);
        }
    }

    public function delete($id)
    {
        // dd($id);
        CaseType::where('id',$id)->first()->delete();
        return response()->json(["status" => true]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $job = new CaseType;
            $job->name = $request->name;
            $job->save();
            DB::commit();
            return response()->json(["status" => true,"name"=>$job->name,"id"=>$job->id,"date"=>$job->formattedDate()]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false]);
        }
    }
}

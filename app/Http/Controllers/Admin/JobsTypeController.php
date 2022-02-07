<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CaseType;
use DB;
use Session;


class JobsTypeController extends Controller
{
    public function index()
    {
        $job = CaseType::all();
        return view('admin.jobtype')->with(['jobs' => $job]);
    }
    
    public function update(Request $request)
    {
        $rules = [
            'ed_jobtype' => 'unique:case_types,name',
        ];

        $messages = [
            'unique'    => 'type name is already used'
        ];
        
        $request->validate($rules, $messages);
        try {
            $job = CaseType::where('id', $request->ed_id)->first();
            $job->name = $request->ed_jobtype;
            $job->save();
            DB::commit();
            Session::flash('message', 'แก้ไขสำเร็จ');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('message', 'แก้ไขไม่สำเร็จ'.$e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
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
        $rules = [
            'name' => 'unique:case_types,name',
        ];

        $messages = [
            'unique'    => 'type :attribute is already used'
        ];
        
        $request->validate($rules, $messages);

        try {
            $job = new CaseType;
            $job->name = $request->name;
            $job->save();
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Equipment;
use DB;
use Session;

class EquipmentController extends Controller
{
    public function index()
    {
        $e = Equipment::all();
        return view('admin.equipment')->with(['e' => $e]);
    }


    public function delete($id)
    {
        try {
            $e = Equipment::where('id', $id)->first();

            if ($e->image) {
                $image_path = public_path() . "/images/" . $e->image;
                unlink($image_path);
            }

            $e->delete();
            DB::commit();
            return response()->json(["status" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false]);
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'unique:equipment,name',
            'amount' => 'required',
            'price'    => 'required'
        ];

        $messages = [
            'required'  => 'The :attribute field is required.',
            'unique'    => 'equipment :attribute is already used'
        ];
        
        $request->validate($rules, $messages);
        
        try {
            $e = Equipment::where('id', $request->id)->first();
            $e->name = $request->name;
            $e->price = $request->price;
            $e->amount = $request->amount;
            $e->update();
            DB::commit();
            Session::flash('message', 'แก้ไขสำเร็จ');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('message', 'แก้ไขไม่สำเร็จ: ' . $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'unique:equipment,name',
            'amount' => 'required',
            'price'    => 'required'
        ];

        $messages = [
            'required'  => 'The :attribute field is required.',
            'unique'    => 'equipment :attribute is already used'
        ];
        
        $request->validate($rules, $messages);

        try {
            $e = new Equipment;

            if ($request->has('select_file')) {
                $image = $request->file('select_file');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $e->image = $new_name;
            }

            $e->amount = $request->amount;
            $e->price = $request->price;
            $e->name = $request->name;
            $e->save();
            DB::commit();
            Session::flash('message', 'บันทึกสำเร็จ');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('message', 'บันทึกไม่สำเร็จ: ' . $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
    }
}

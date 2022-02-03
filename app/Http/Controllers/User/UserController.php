<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CaseType;
use App\JobCase;
use Auth;
use App\User;
use DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $case = JobCase::where('userId',$user->id)->get();
        $M_to_string = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];

        
        $graph = JobCase::where('userId', Auth::user()->id)
                ->where("created_at", ">", Carbon::now()->subMonths(6)->firstOfMonth())
                ->selectRaw('year(created_at) year, month(created_at) month, count(id) data')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->get();
       
        $graph_label = [];
        $graph_data = [];
        foreach($graph as $value){
            array_push($graph_label, $M_to_string[$value->month] ." ".$value->year );
            array_push($graph_data, $value->data);
            
        }
       
        return view('templates.user')->with([
            "selects" => CaseType::all(), 
            "user" => $user,
            "cases" => $case,
            "label" => $graph_label,
            "data" => $graph_data
        ]);
    }

    public function job($id)
    {
        $id = (int)$id;
        $userId = Auth::id();
        $db = JobCase::where('id',$id)->where('userId',$userId)->firstOrFail();
        return view('user.job')->with(['job'=>$db]);
    }


    public function update(Request $request)
    {

        try {
            $user = User::where('id', Auth::user()->id)->first();
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->address = $request->pfAddress;
            $user->phone = $request->phone;
            $user->save();
            DB::commit();
            return response()->json(["status" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false]);
        }
    }
}

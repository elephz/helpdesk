<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where('roleid','1')->get();
        return view('admin.user')->with(['users' => $users]);
    }

    public function Banned(Request $request)
    {
    
        try {
            $user = User::where('id', $request->data)->first();
            // dd($user->baned);
            $user->baned = !$user->baned;
            $user->update();
            DB::commit();
            return response()->json(["status" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false]);
        }
    }

    public function TechDetail($id)
    {
        $user = User::where('id', $id)->where('roleid',2)->where('acceptTeach','2')->first();
        
        return view('admin.tech')->with(['user'=>$user]);
    }

    public function profile($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.userdetail')->with(['user'=>$user]);
        
    }

    public function acceptTech(Request $request)
    {

        try {
            $user = User::where('id', $request->data)->first();
            $user->acceptTeach = 2;
            $user->save();
            DB::commit();
            return response()->json(["status" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["status" => false]);
        }
    }
    public function allTech()
    {
        $users = User::where('roleid', '2')->where('acceptTeach','2')->get();
        return view('admin.allTech')->with(['users' => $users]);
    }

    public function newTech()
    {
        $users = User::where('roleid','2')->where('acceptTeach','1')->get();
       
        return view('admin.newTech')->with(['users' => $users]);
    }

   
}

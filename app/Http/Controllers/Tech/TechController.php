<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobCase;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TechController extends Controller
{
    public function index()
    {
        $Userid = Auth::id();
        $job = JobCase::where('techId', $Userid)->get();
        // dd($job);
        $success = JobCase::where('techId', $Userid)->where('jobStatus', '3')->get();
        $cancel = JobCase::where('techId', $Userid)->where('jobStatus', '4')->get();
        $jobTypedata = [];
        $jobTypelabel = [];
        $timeArr = [];
        $jobType = JobCase::where('techId', $Userid)
            ->groupBy('caseTypeId')
            ->selectRaw('count(*) as total, caseTypeId')
            ->get();

        foreach ($jobType as $jobs) {
            array_push($jobTypedata, $jobs->total);
            array_push($jobTypelabel, $jobs->JobType->name);
        }

        foreach($success as $time){
            array_push($timeArr,Carbon::parse($time->acceptTime)->diff(Carbon::parse($time->successTime))->format('%H:%I'));
        }

        $total = 0;
        foreach( $timeArr as $element):
      
            // Explode by seperator :
            $temp = explode(":", $element);
              
            // Convert the hours into seconds
            // and add to total
            $total+= (int) $temp[0] * 3600;
              
            // Convert the minutes to seconds
            // and add to total
            $total+= (int) $temp[1] * 60;
              
           
        endforeach;
          
        // Format the seconds back into HH:MM:SS
        $totaltime = sprintf('%02d:%02d:%02d', 
                        ($total / 3600),
                        ($total / 60 % 60),
                        $total % 60);
        // dd($formatted);
        //   dd($timeArr,max($timeArr),min($timeArr),$totaltime,);
       
        return view('tech.dashboard')->with([
            'jobs' => count($job),
            'success' => $this->calculate(count($success), count($job)),
            'cancel' =>  $this->calculate(count($cancel), count($job)),
            'jobTypedata' =>  $jobTypedata,
            'jobTypelabel' =>  $jobTypelabel,
            'totaltime' => $totaltime,
            'timearr' => $timeArr,
            'avg' => date('H:i', array_sum(array_map('strtotime', $timeArr)) / count($timeArr))
        ]);
    }
    public function calculate($value,$max)
   {
       return  number_format(($value * 100) / $max,2) ;
   }
    public function Jobs()
    {
        return view('tech.jobs');
    }

    public function wait()
    {
        return view('tech.wait');
    }
}

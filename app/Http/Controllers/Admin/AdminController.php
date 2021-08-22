<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\JobCase;
use Carbon\Carbon;
use DB;
use App\Using_Eq;
class AdminController extends Controller
{
    public function index()
    {
        $M_to_string = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];

        $jobTypedata = [];
        $jobTypelabel = [];
        $jobStatusdata = [];
        $jobStatuslabel = [];
        $user = User::where('roleid', '1')->get();
        $tech = User::where('roleid', '2')->where('acceptTeach', '2')->get();
        $allJob = JobCase::get();
        $newJob = JobCase::where('jobStatus', '1')->get();

        $jobType = JobCase::groupBy('caseTypeId')
            ->selectRaw('count(*) as total, caseTypeId')
            ->get();

        foreach ($jobType as $job) {
            array_push($jobTypedata, $this->calculate($job->total, $allJob->count()));
            array_push($jobTypelabel, $job->JobType->name);
        }

        $jobStatus = JobCase::where('jobStatus', '<', '3')->groupBy('jobStatus')
            ->selectRaw('count(*) as total, jobStatus')
            ->get();

        foreach ($jobStatus as $job) {
            array_push($jobStatusdata, $job->total);
            array_push($jobStatuslabel, $job->JobStatus($job->jobStatus));
        }
        $graph = JobCase::where("assginTime", ">", Carbon::now()->subMonths(12)->firstOfMonth())
            ->selectRaw('year(assginTime) year, month(assginTime) month, count(id) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'asc')
            ->get();

        $graph_label = [];
        $graph_data = [];
        foreach ($graph as $value) {
            array_push($graph_label, $M_to_string[$value->month] . " " . $value->year);
            array_push($graph_data, $value->data);
        }
       
       
      

        $salary = JobCase::all()->sum('to_tal');
        $today_salary = 0;
        $qr = JobCase::whereDate('updated_at',Carbon::today())
            ->where('jobStatus',3)
            ->get();

        foreach($qr as $item){
            $today_salary += $item->to_tal;
        }
      

        return view('admin.dashboard')->with([
            "user" => $user->count(),
            "tech" => $tech->count(),
            "newJob" => $newJob->count(),
            "allJob" => $allJob->count(),
            "jobTypedata" => $jobTypedata,
            "jobTypelabel" => $jobTypelabel,
            "jobStatusdata" => $jobStatusdata,
            "jobStatuslabel" => $jobStatuslabel,
            "label" => $graph_label,
            "data" => $graph_data,
            "salary" => $salary,
            "today_salary" => $today_salary
        ]);
    }

    public function calculate($value, $max)
    {
        return  number_format(($value * 100) / $max, 2);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Using_Eq;
class JobCase extends Model
{
    public function JobType()
    {
        return $this->hasOne(CaseType::class, 'id', 'caseTypeId');
    }

    public function getJobIdAttribute()
    {
        return str_pad($this->id,5,'0',STR_PAD_LEFT);
    }
  
    public function Equipment()
    {
        $id = $this->id;
        $result = Using_Eq::where('job_case_id',$id)->get();
        return $result ? $result : [];
    }

    public function calculate($value, $max)
    {
        return  number_format(($value * 100) / $max, 2);
    }

    public function JobStatus()
    {
        $arr = ['', 'งานใหม่', 'กำลังดำเนินการ', 'เสร็จสิ้น', 'ยกเลิก'];
        return $arr[$this->jobStatus];
    }
    public function StatusColor()
    {
        $arr = ['', 'bg-primary', 'bg-warning', 'bg-success', 'bg-danger'];
        return $arr[$this->jobStatus];
    }

    public function diffDate($start, $end)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);
        return $end->diff($start)->format('%d วัน %h ชั่วโมง');
    }
    public function formattedDate($date)
    {
        // dd(gettype($date));
        if ($date) {
            $date = Carbon::parse($date);
            return $date->format('H:i d/m/Y');
        }
    }
    public function formattedDate_time()
    {
        if ($this->created_at) {
            $date = Carbon::parse($this->created_at);
            return [$date->format('d/m/Y'), $date->format('H:i')];
        }
    }
    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function getTech()
    {
        return $this->hasOne(User::class, 'id', 'techId') ?? " ";
    }

    // public function getCover()
    // {
    //     return $this->hasOne(User::class, 'id', 'techId');
    // }

    public function getImg()
    {
        $website = str_contains($this->image, 'https') ? true : false ;
        if ($this->image == null && !$website) {
            return asset('web_images/available.png');
        }
        if ($website) {
            return $this->image;
        }

        return asset('images/' . $this->image);
    }           

    public function hardward()
    {
        return $this->hasMany(Using_Eq::class,'job_case_id','id');
    }

    public function getTotalAttribute()
    {
        return $this->wage + $this->hardward->sum('to_tal');
    }

    public function getHardwareReportAttribute()
    {
        $amount = 0;
        $total = 0;

        foreach($this->hardward as $item){
            $total += $item->Total;
            $amount += $item->amount;
        }
        $ordertotal = $total + $this->wage + $this->tech_wage;
        return (object)['total'=>$total,'amount'=>$amount,'ordertotal'=>$ordertotal];

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JobCase extends Model
{
    public function JobType()
    {
        return $this->hasOne(CaseType::class, 'id', 'caseTypeId');
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

    public function getCover()
    {
        return $this->hasOne(User::class, 'id', 'techId');
    }

    public function getImg()
    {
        if ($this->img == null) {
            return asset('web_images/available.png');
        }
        if (str_contains($this->img, 'https')) {
            return $this->img;
        }
        return asset('images/' . $this->image);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Using_Eq extends Model
{
    // protected $appends = ['Total'];
    public function equipment()
    {
        return $this->hasOne(Equipment::class,'id','equipment_id');
    }

    public function getTotalAttribute()
    {
        return $this->amount * $this->equipment->price;
    }
}

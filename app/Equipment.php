<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function getCover()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }
        return asset('web_images/available.png');
       
    }
}

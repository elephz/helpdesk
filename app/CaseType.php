<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CaseType extends Model
{
    public function formattedDate()
    {
        return $this->created_at->format('d/m/Y');
    }
}

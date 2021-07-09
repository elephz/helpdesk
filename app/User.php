<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','lastname','roleid','baned'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Status()
    {
       
        $role = ['','ผู้ใช้ทั่วไป','ช่างเทคนนิค','admin'];
        return $role[$this->roleid];
    }

    public function getFullname()
    {
        return $this->name." ".$this->lastname;
    }
    public function isAdmin()
    {
        if($this->roleid == 3){
            return true;
        }else{
            return false;
        }
    }

    public function isTech()
    {
        if($this->roleid == 2 && $this->acceptTeach == 2){
            return true;
        }else{
            return false;
        }
    }

    public function waitTech()
    {
        if($this->roleid == 2 && $this->acceptTeach == 1){
            return true;
        }else{
            return false;
        } 
    }

    public function isUser()
    {
        if($this->roleid == 1){
            return true;
        }else{
            return false;
        }
    }
    public function isBaned()
    {
        return $this->baned == 1 ?  true : false ;
    }


    public function formattedDate($date)
    {
        // dd(gettype($date));
        if($date){
            $date = Carbon::parse($date);
            return $date->format('H:i d/m/Y');
        }
    }

    public function getTechCount()
    {
        return $this->hasMany(JobCase::class,'techId','id')->where('jobStatus','<','4');
    }
}

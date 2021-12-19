<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    protected $table = 'visitors';
    public $timestamps = true;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['times','auth_state','user_ip','country','user_id'];


    public function ScopeCountByCountry($query,$country = "Egypt")
    {
        return count($query->where('country',$country)->get());
    }
}

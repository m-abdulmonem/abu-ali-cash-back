<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('company_name', 'company_logo', 'vip_reward', 'reward', 'linke', 'exceptions', 'about_store','coupon_code', 'category_id', 'file_id');

    public function cashBack()
    {
        return $this->hasMany('App\Models\CashBack');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }

}

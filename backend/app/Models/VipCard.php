<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VipCard extends Model 
{

    protected $table = 'vip_cards';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('coupon_code', 'price', 'status', 'user_id');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
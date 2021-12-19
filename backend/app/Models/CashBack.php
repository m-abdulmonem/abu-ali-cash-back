<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashBack extends Model 
{

    protected $table = 'cash_back';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('title', 'vip_reward', 'reward', 'offer_id');

    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'details', 'subchild', 'link','name_ar');

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function coupons()
    {
        return $this->hasMany('App\Models\Coupon');
    }

}

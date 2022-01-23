<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    //
    protected $table = 'orders';
    protected $fillable = ['prod_id', 'user_id', 'quantity', 'status', 'city', 'sub-city', 'house-no', 'total'];
    public function product()
    {
         return $this->hasOne(products::class, 'id', 'prod_id');
    }
    public function user_profile()
    {
        return $this->hasMany(userProfile::class, 'id', 'user_id');
    }
}

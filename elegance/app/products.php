<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //
    protected $table='products';
    protected $fillable = ['adminId','productName', 'productDesc', 'prodImage', 'price', 'catId'];
    public function admins()
    {
         return $this->belongsTo(adminProfile::class, 'adminId');
    }
    public function category()
    {
        return $this->hasOne(category::class, 'id', 'catId');
    }
    public function orders()
    {
           return $this->belongsTo(orders::class);
    }
}

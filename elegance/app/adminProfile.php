<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminProfile extends Model
{
    //
    protected $table = 'admin_profiles';
    protected $fillable = ['storeName', 'storeDesc', 'user_id'];
    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(products::class, 'adminId');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userProfile extends Model
{
    //
    protected $table = 'user_profiles';
    protected $fillable = ['user_id', 'profile_pic', 'phone_number', 'Location'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function orders()
    {
        return $this->hasMany(orders::class, 'user_id', 'o');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    protected $fillable = ['catName', 'catDesc'];
    public function product()
    {
        return $this->belongsTo(products::class);
    }
}

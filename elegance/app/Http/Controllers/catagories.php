<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class catagories extends Controller
{
    //
    public function catCreate()
    {
        $res = category::all();
        return view('Admin.category', ['cats'=>$res]);
    }
    public function catUpload(Request $data) {
        category::create([
            'catName'=>$data['catName'],
            'catDesc'=>$data['catDesc']
        ]);
        return redirect()->route('createCat');
    }
}

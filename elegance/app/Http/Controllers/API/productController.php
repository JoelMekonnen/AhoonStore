<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\products;
use App\Http\Controllers\API\BaseController as BaseController;

class productController extends BaseController
{
    //
    public function show()
    {
         $prods = products::all();
         return $this->sendResponse($prods, "All products");
    }
    public function showDetail($id)
    {
        $prods = products::find($id);
        return $this->sendResponse($prods, "product found");
    }

}

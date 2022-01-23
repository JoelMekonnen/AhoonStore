<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\adminProfile;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    //
    public function create(Request $data)
    {

        $fileData = $data->file('prodPics');
        $fileName = time().$fileData->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            'public/product/',
            $fileData,
            $fileName
        );
        $admin = adminProfile::where('user_id', '=', Auth::user()->id)->get();
        echo $admin;
        $newProd = products::create([
            'productName'=>$data['productName'],
            'productDesc'=>$data['productDesc'],
            'price'=>$data['price'],
            'adminId'=> $admin[0]["id"],
            'catId'=>$data['catSelect'],
            'prodImage'=>$fileName,
        ]);
//        $newProd->adminId = Auth::user()->id;
        $newProd->save();
        return redirect()->route('adminHome');
    }
    public function showProducts()
    {
        $admin= adminProfile::where('user_id', '=', Auth::user()->id)->get();
        $prods = products::where('adminId', '=', $admin[0]["id"])->get();
        return view('Admin.adminShowProducts', ["products"=>$prods]);
    }
    public function getUpdateProduct($id)
    {
        $prods = products::find($id);
        return view('Admin.adminUpdateProducts', ['prods'=>$prods]);
    }
    public function updateProduct(Request $data, $id) {
        $prods = products::find($id);;
        $prods->productName = $data['productName'];
        $prods->productDesc = $data['productDesc'];
        $prods->price = $data['price'];
        $prods->save();
        return redirect()->route('showProds');
    }
}

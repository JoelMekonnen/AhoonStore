<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\adminProfile;
use App\category;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/login';
    protected function adminSign()
    {
        return view('Admin.adminSign');
    }
    protected function adminHome()
    {
        $availCats = category::all();
        return view('Admin.adminCreateProduct', ['cats'=>$availCats]);
    }
    // lets create the admin signup and other index views
   protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|max:10|unique:users',
            'storeName' => "required|string|max:255",
            'storeDesc' => "required|string|max:300",
        ]);
   }

   protected function create(Request $data)
   {
      $adminUser = User::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'password' => Hash::make($data['password']),
             'isAdmin' => '1',
             'username' => $data['username'],
         ]);
     $admins = adminProfile::create([
            'user_id' => $adminUser['id'],
            'storeName'=>$data['storeName'],
            'storeDesc'=>$data['storeDesc']
      ]);
      return redirect()->route('login');
   }
}

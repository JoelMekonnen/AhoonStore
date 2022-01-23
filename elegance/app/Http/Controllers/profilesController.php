<?php

namespace App\Http\Controllers;

use App\products;
use App\category;
use App\User;
use App\userProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class profilesController extends Controller
{
    //
    public function Index()
    {
        $users = Auth::user();
        $loggedIn = Auth::check();
        if($loggedIn && !$users->isAdmin)
        {
            $products = products::orderBy('created_at', 'DESC')->take(10)->get();
            $categories = category::all();
            return view('Users.userHome', ['prods'=>$products, 'cats'=>$categories]);
        } else {
            return redirect()->route('login');
        }

    }
    public function showUserCreate()
    {
         return view('Users.getUserCreate');
    }
    public function createUsers(Request $request)
    {
        $profileData = $request->file('profilePics');
        $fileName = time().$profileData->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            'public/profilePics',
            $profileData,
            $fileName
        );
        $user = User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
            'isAdmin'=>'0',
            'username'=>$request['username']
        ]);
        $userProfile = userProfile::create([
              'user_id'=> $user['id'],
              'Location'=> $request['location'],
              'profile_pic'=> $fileName,
              'phone_number'=>$request['phone_number']
        ]);
        return redirect()->route('login');
    }
}

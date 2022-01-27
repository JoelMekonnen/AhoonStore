<?php

namespace App\Http\Controllers\API;

use App\User;
use App\userProfile;
use Illuminate\Support\Facades\Auth;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class profilesController extends BaseController
{
    // In this function we register the users
    public function register(Request $request)
    {
        $user_create = User::create([
            'name'=>$request["name"],
            'username'=>$request["username"],
            'email'=>$request["email"],
            'isAdmin'=>false,
            'password'=>bcrypt($request["password"])
        ]);
        $profileData = $request->file('profilePics');
        $fileName = $profileData->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            'public/profilePics',
            $profileData,
            $fileName
        );
        $profile_create = userProfile::create([
              'user_id'=>$user_create["id"],
              'Location'=>$request["Location"],
              'phone_number'=>$request["phone_number"],

              'profile_pic'=>$fileName
        ]);
        $success = ["user"=>$user_create, "profile"=>$profile_create];
        return $this->sendResponse($success, 'user registered successfully');
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message'=>'successfully loggedout']);
    }
    public function getUser()
    {
          $user = Auth::user();
          $profile = userProfile::where('user_id', '=', $user->id)->get();
          $result = ['user'=>$user, 'profile'=>$profile[0]];
          return $this->sendResponse($result, 'fetched user');
    }
}

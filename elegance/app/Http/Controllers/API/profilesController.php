<?php

namespace App\Http\Controllers\API;

use App\User;
use App\userProfile;
use Illuminate\Support\Facades\Auth;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class profilesController extends BaseController
{
    // In this function we register the users
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'name'=>'required',
             'username'=>'required',
             'email'=>'required|email',
             'password'=> 'required',
             'c_password'=>'required|same:password',
        ]);
        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $success['token'] = $user->createToken('UserApp')->accessToken;
        $success['user'] = $user;
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

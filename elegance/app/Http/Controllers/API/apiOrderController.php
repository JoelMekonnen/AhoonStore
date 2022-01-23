<?php

namespace App\Http\Controllers\API;

use App\products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\orders;
use Illuminate\Support\Facades\Validator;

class apiOrderController extends BaseController
{
      public function createOrder(Request $request)
      {
           echo $request;
           $validator = Validator::make($request->all(), [
                 'prod_id'=>'required',
                 'quantity'=>'required',
                 'city'=>'required',
                 'sub-city'=>'required',
                 'house-no' => 'required',
           ]);
          if($validator->fails()) {
              return $this->sendError('Validation Error', $validator->errors());
          }
          $prods = products::find($request['prod_id']);
          $total = $request['quantity'] * $prods->price;
          $newOrder = orders::create([
                'prod_id' => $request['prod_id'],
                'user_id' => $request['user_id'],
                'quantity'=> $request['quantity'],
                'city'=>$request['city'],
                'sub-city'=>$request['sub-city'],
                'house-no' => $request['house-no'],
                'total' => $total,
                'status'=> 'pending',
          ]);
          return $this->sendSuccess();
      }
      public function userGetPendingHistory()
      {
           $loggedUser = Auth::user();
           $orders = orders::where('user_id', '=', $loggedUser->id);
           return $this->sendResponse($orders);

      }
}

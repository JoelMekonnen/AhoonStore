<?php

namespace App\Http\Controllers;

use App\adminProfile;
use App\orders;
use Illuminate\Http\Request;
use App\products;
use App\userProfile;
use Illuminate\Support\Facades\Auth;


class orderController extends Controller
{
    // let create all the order controllers
    public function getOrder($id)
    {
        $detProd = products::where('id', '=', $id)->get();
         return view('Orders.getProdOrder', ['prods'=>$detProd]);
    }
    public function createOrder(Request $request, $id)
    {
        $userID = Auth::user();
        $prod = products::where('id', '=', $id)->get();
        $total = $request['quantity'] * $prod[0]->price;
        $profile = userProfile::where('user_id', '=', $userID->id)->get();
        $newOrder = orders::create([
               'user_id'=> $profile[0]->id,
               'prod_id'=> $id,
               'quantity'=>$request['quantity'],
               'city'=>$request['city'],
               'sub-city'=>$request['sub-city'],
               'house-no'=>$request['house-no'],
               'status'=>'pending',
               'total'=> $total
        ]);
        return redirect()->route('userHome');
    }
    public function getOrderRequests()
    {
         $loggedAdmin = Auth::user();
         $admin = adminProfile::where('user_id', '=', $loggedAdmin->id)->get();
         $orders = array("pending"=>array());
         if($loggedAdmin->isAdmin)
         {
              $prodOrders = orders::all();
              foreach($prodOrders as $prodOrder)
              {
                  if($prodOrder->product->admins->id == $admin[0]->id && !empty($prodOrder))
                  {
                      if($prodOrder->status == "pending")
                      {
                          array_push($orders["pending"], $prodOrder);
                      }
                  }
              }
             return view("Admin.requests", ['orders'=>$orders]);
//        dd($orders);
         }
    }
    public function getDeclinedRequests()
    {
        $loggedAdmin = Auth::user();
        $admin = adminProfile::where('user_id', '=', $loggedAdmin->id)->get();
        $orders = array("failed"=>array());
        if($loggedAdmin->isAdmin) {
            $prodOrders = orders::all();
            foreach ($prodOrders as $prodOrder) {
                if ($prodOrder->product->admins->id == $admin[0]->id && !empty($prodOrder)) {
                    if ($prodOrder->status == "failed") {
                        array_push($orders["failed"], $prodOrder);
                    }
                }
            }
        }
            return view("Admin.declined", ['orders'=>$orders]);
    }
    public function getApprovedRequests()
    {
        $loggedAdmin = Auth::user();
        $admin = adminProfile::where('user_id', '=', $loggedAdmin->id)->get();
        $orders = array("approved"=>array());
        if($loggedAdmin->isAdmin) {
            $prodOrders = orders::all();
            foreach ($prodOrders as $prodOrder) {
                if ($prodOrder->product->admins->id == $admin[0]->id && !empty($prodOrder)) {
                    if ($prodOrder->status == "approved") {
                        array_push($orders["approved"], $prodOrder);
                    }
                }
            }
        }
        return view("Admin.approved", ['orders'=>$orders]);
    }
    public function postOrderAction($id, $action)
    {
          $getOrder = orders::find($id);
          if($action == "approved") {
               $getOrder->status = "approved";
               $getOrder->save();
          } else if ($action == "decline") {
               $getOrder->status = "failed";
               $getOrder->save();
          } else {
              echo "action not allowed";
          }
         return redirect()->route('getRequest');
    }
}

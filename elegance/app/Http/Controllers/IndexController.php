<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\adminProfile;
use Illuminate\Support\Facades\Auth;
use App\products;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function Homepage()
    {
        $loggedIn = Auth::check();
        $user = Auth::user();
        $prods = products::all();
        if($loggedIn && $user->isAdmin)
        {
          return View('Admin.adminCreateProduct');
        } else if ($loggedIn && !$user->isAdmin) {
            return redirect()->route('userHome');
        }
        return View('Index', ['products'=>$prods]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\TopUp;
use App\Models\TarikTunai;
use App\Models\WD;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request){
        $products = "";

        if($request->category == ""){
            $products = Product::all();
        } else {
            $products = Product::where('category_id',$request->category)->get();
        }

        $categories = Category::all();

        return view('index',compact('products','categories'));
    }



    public function profile(){
        $transactions = Transaction::where('user_id', Auth::user()->id)
        ->where('status','paid')
        ->orWhere('status','taken')
        ->orderByDesc('updated_at')
        ->get()
        ->groupBy('updated_at');

        $topups = TopUp::where('user_id', Auth::user()->id)
        ->orderByDesc('created_at')
        ->get()
        ->groupBy('created_at');

        $tariktunais = WD::where('user_id', Auth::user()->id)
        ->orderByDesc('created_at')
        ->get()
        ->groupBy('created_at');

        return view('profile', compact('transactions','topups','tariktunais'));
    }
}

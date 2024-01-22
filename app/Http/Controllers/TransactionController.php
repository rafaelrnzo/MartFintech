<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\TopUp;
use App\Models\TarikTunai;
use App\Models\WD;

class TransactionController extends Controller
{
    public function cart_index(){
        $total_prices_all = 0;
        $transactions = Transaction::where('user_id' , Auth::user()->id)->where('status','not_paid')->get();

        foreach($transactions as $transaction){
            $total_prices_all +=  $transaction->total_price;
        }



        return view('cart',compact('transactions','total_prices_all'));
    }

    public function add_to_cart(Request $request){

       $product_to_buy = Product::find($request->product_id);
       $product_price = $product_to_buy->price;

       if(!Auth::check()) return redirect()->route('login');

       $total_prices_sum = ($request->quantity * $product_price);

       if(Auth::user()->wallet->credit < $total_prices_sum){
           return redirect()->back()->with('message',['error','saldo anda tidak cukup']);
       }


       $sameTransaction = Transaction::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->where('status','not_paid')->first();

       if($sameTransaction){
         $quantity = $sameTransaction->quantity += $request->quantity;
         $sum_price = $quantity * $product_to_buy->price;
         $sameTransaction->update([
           "quantity" => $quantity,
           "total_price" => $sum_price,
         ]);

       }
       else {
        Transaction::create([
            "user_id" => Auth::user()->id,
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
            "total_price" => $total_prices_sum,
            "order_id" => "INV-" . Auth::user()->id . now()->format('dmYHis'),
            "status" => "not_paid"
         ]);
       }

       return redirect()->route('cart.index');

    }


    public function payCart(Request $request){

        $total_prices = $request->total_prices;


        $transaction_to_pay = Transaction::where('status','not_paid')->where('user_id', Auth::user()->id)->get();
        $user_wallet = Wallet::where('user_id',Auth::user()->id)->first();

        $current_debit = $user_wallet->debit;
        $current_credit = $user_wallet->credit;
        

        foreach($transaction_to_pay as $per_transaction){
            $quantity = $per_transaction->quantity; 
            $product = $per_transaction->product; 
            $new_stock = $product->stock - $quantity;
        
        
            $product->update([
                "stock" => $new_stock
            ]);
        }

        foreach($transaction_to_pay as $per_transaction){
            $per_transaction->update([
                 "status" => "paid"
            ]);
         }


         $user_wallet->update([
             "credit" => ($current_credit -= $total_prices),
             "debit" => ($current_debit += $total_prices)
         ]);


         return redirect()->route('receipt')->with('total_prices', $total_prices);
    }

    public function receipt(){
        $transactions = Transaction::where('status','paid')->where('user_id', Auth::user()->id)->get();

        return view('receipt.receipt',compact('transactions'));
    }


    public function receipt_topup(string $order_id){
        $topups = TopUp::where('order_id',$order_id)->first();
        return view('receipt.topupreceipt',compact('topups'));
    }

    public function receipt_take(){
        $transactions = Transaction::where('status','paid')->where('user_id',Auth::user()->id)->get();

        foreach($transactions as $transaction){
            $transaction->update([
               "status" => "taken"
            ]);
        }

        return redirect()->route('index');
    }

    public function receipt_tariktunai(string $order_id){
        $tariktunais = WD::where('order_id',$order_id)->first();

        return view('receipt.tariktunai_receipt', compact('tariktunais'));
    }


    public function topup(){    
        return view('topup');
    }

    public function topup_proceed(Request $request){
       $topup = TopUp::create([
            "user_id" => Auth::user()->id,
            "order_id" => "TU-" . Auth::user()->id . now()->format('dmYHis'),
            "nominals" => $request->nominal,
            "status" => 'unconfirmed',
       ]);


       return redirect()->route('topup.receipt' ,$topup->order_id);
    }

    public function cart_delete(int $id){
        $cart_to_delete = Transaction::find($id);

        $cart_to_delete->delete();

        return redirect()->back();

    }

    public function tarik_tunai(){
        return view('tariktunai');
    }

    public function tarik_tunai_store(Request $request){
        $current_user_balance =  Auth::user()->wallet->credit;

        if($request->nominals > $current_user_balance){
            alert()->error('Gagal','Saldo Anda Tidak Mencukupi');
            return redirect()->back();            
        } 

        $tariktunai  = WD::create([
            "user_id" => Auth::user()->id,
            "nominals" => $request->nominals,
            "status" => "unconfirmed",
            "order_id" => "TTN-" . Auth::user()->id . now()->format('dmYHis'),
        ]);

        return redirect()->route('tarik.tunai.receipt', $tariktunai->order_id);
    }


}

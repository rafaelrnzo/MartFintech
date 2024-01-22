<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\TarikTunai;
use App\Models\TopUp;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;
use App\Models\User;
use App\Models\WD;
use Carbon\Carbon;


class BankController extends Controller
{
    public function index()
    {
        $topups= TopUp::all();
        $topups5 = TopUp::paginate(5)->sortByDesc('created_at');
        $tariktunais5 = WD::paginate(5)->sortByDesc('created_at');;

        $tariktunais = WD::all();

        return view('bank.index', compact('topups','tariktunais','topups5','tariktunais5'));
    }

    public function topup()
    {
        $topups = TopUp::orderByDesc('created_at')->get();
        return view('bank.confirmtopup', compact('topups'));
    }

    public function topupstore(Request $request)
    {
        $topup = TopUp::find($request->topup_id);
        $user_wallet = Wallet::where('user_id', $request->user_id)->first();
        $updated_wallet = ($user_wallet->credit += $topup->nominals);
        $user_wallet->update([
          "credit" => $updated_wallet
        ]);

        $topup->update([
          "status" => "confirmed"
        ]);

        alert()->success('Success', 'Success Konfirmasi Top Up User!');

        return redirect()->back();
    }

    public function topupreject(Request $request)
    {
        $topup = TopUp::find($request->topup_id);
        $topup->update([
          "status" => "rejected"
        ]);

        alert()->success('Success', 'Success Membatalkan Top Up!');

        return redirect()->back();
    } 

    public function topupnew(){
       $users = User::where('role_id',1)->get();
       return view('bank.newtopup',compact('users'));
    }

    public function topupnewpost(Request $request){
       $user_wallet = Wallet::where('user_id',$request->user)->first();
       $topup = TopUp::create([
        "user_id" => $request->user,
        "nominals" => $request->nominals,
        "status" => "confirmed",
        "order_id" => "TTN-" . $request->user . now()->format('dmYHis'),
       ]);

       $updated_wallet = ($user_wallet->credit += $topup->nominals);
        $user_wallet->update([
          "credit" => $updated_wallet
        ]);

        alert()->success('Success','Success Membuat Top Up Baru');
 
        return redirect()->route('bank.topup.index');
       
    }

    public function tarik_tunai()
    {
        $tariktunais = WD::all();
        return view('bank.tariktunai', compact('tariktunais'));
    }

    
    public function tarik_tunai_new()
    {
      $users = User::where('role_id',1)->get();
      return view('bank.newtariktunai',compact('users'));
    }



    public function tarik_tunai_newpost(Request $request){
      $user_wallet = Wallet::where('user_id',$request->user)->first();
      
      if($user_wallet->credit < $request->nominals) {
          alert()->error('Gagal','Saldo User Tidak Mencukupi Untuk Melakukan Tarik Tunai');
          return redirect()->back();
      }

      $topup = WD::create([
       "user_id" => $request->user,
       "nominals" => $request->nominals,
       "status" => "confirmed",
       "order_id" => "TTN-" . $request->user . now()->format('dmYHis'),
      ]);

      $updated_wallet = ($user_wallet->credit -= $topup->nominals);
       $user_wallet->update([
         "credit" => $updated_wallet
       ]);

       alert()->success('Success','Success Membuat Tarik Tunai Baru');

       return redirect()->route('bank.tariktunai');
      
   }

    public function tarik_tunai_store(Request $request)
    {
        $wallet = Wallet::find($request->user_id);
        $tarik_tunai = WD::find($request->tariktunai_id);
        $wallet->update([
          "credit" => ($wallet->credit -= $request->nominals),
          "debit" => ($wallet->debit += $request->nominals)
        ]);

        $tarik_tunai->update([
          "status" => "confirmed"
        ]);

        alert()->success('Success', 'Success Konfirmasi Tarik Tunai User!');

        return redirect()->back();
    }

    public function tarik_tunai_reject(Request $request)
    {
        $tarik_tunai = WD::find($request->tariktunai_id);

        $tarik_tunai->update([
          "status" => "rejected"
        ]);

        alert()->success('Success', 'Success Membatalkan Tarik Tunai User!');

        return redirect()->back();
    }

    public function transactionindex()
    {
        $topups = TopUp::where('status', 'confirmed')
        ->orWhere('status', 'rejected')
        ->orderBy('updated_at')
        ->get()->groupBy(function($item) {
          return Carbon::parse($item->updated_at)->format('Y-m-d');
        });

        $tariktunais = WD::where('status', 'confirmed')
        ->orWhere('status', 'rejected')
        ->orderBy('updated_at')
        ->get()->groupBy(function($item) {
          return Carbon::parse($item->updated_at)->format('Y-m-d');
        });

        return view('bank.transaction', compact('topups','tariktunais'));
    }

    public function print(string $date)
    {
        $date = Carbon::parse($date)->format('Y-m-d'); 
        $topups = TopUp::whereIn('status', ['confirmed', 'rejected'])->whereDate('updated_at', $date)->get();
      

        return view('bank.print', compact('topups', 'date'));
    }



}

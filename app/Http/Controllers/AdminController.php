<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Role;
use App\Models\Wallet;


class AdminController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $users = User::all();
        return view('admin.index',compact('transactions','users'));
    }

    public function userindex()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function adduserindex()
    {
        $roles = Role::all();
        return view('admin.adduser', compact('roles'));
    }

    public function adduserstore(Request $request)
    {
        $checkUser = User::where('name', $request->name)->first();

        if ($checkUser) {
            alert()->error('Gagal',"Nama User $request->name Sudah Digunakan");
            return redirect()->route('admin.adduser'); 
        } 

        $request->validate([
            "name" => "required",
            "password" => "required",
            "role" => "required"
        ]);



       $user = User::create([
            "name" => $request->name,
            "password" => $request->password,
            "role_id" => $request->role
        ]);
        
        Wallet::create([
            "user_id" => $user->id,
            "credit" => 0,
            "debit" => 0
         ]);
 
        alert()->success('Success','Success Menambahkan User!');

        return redirect()->route('admin.adduser');
    }

    public function edituserindex(int $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.edit', compact('user', 'roles'));
    }

    public function updateuserstore(int $id, Request $request)
    {
        $user = User::find($id);
        $user->update([
            "name" => $request->name,
            "role_id" => $request->role
        ]);

        alert()->success('Success',"Success Mengupdate User");
         
        return redirect()->route('admin.edituserindex', $user->id);
    }


    public function deleteuser(int $id)
    {
        $user = User::find($id);
        $user->delete();
        alert()->success('Success','Berhasil Menghapus User!');
        return redirect()->back();
    }

    public function transactionindex()
    {
        $transactions = Transaction::where('status', 'paid')->orWhere('status', 'taken')->orderBy('updated_at')->get()->groupBy('updated_at');
        return view('admin.transaction', compact('transactions'));
    }



    public function print(string $date, string $user_id)
    {
        $user = User::find($user_id);
        $transactions = Transaction::where('user_id', $user_id)
            ->whereIn('status', ['paid', 'taken'])
            ->where('updated_at', urldecode($date))
            ->get();

        return view('admin.print', compact('transactions','user'));
    }
}
  
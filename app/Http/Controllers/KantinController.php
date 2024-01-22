<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;


class KantinController extends Controller
{
    public function index()
    {
        $transactions = Transaction::paginate(5);
        $products = Product::paginate(5);
        return view('canteen.index', compact('transactions', 'products'));
    }

    public function productindex()
    {
        $products = Product::all();
        return view('canteen.product', compact('products'));
    }

    public function addproductindex()
    {
        $categories = Category::all();
        return view('canteen.addproduct', compact('categories'));
    }


    public function addproductstore(Request $request)
    {
        $imageThumbnail = "";
        if($request->hasFile('image')) {
            $imageThumbnail = $request->file('image')->move('images/', $request->file('image')->getClientOriginalName() . now()->format('dmYHis') . $request->file('image')->getClientOriginalExtension());
        }

        $thumbnailPath = $imageThumbnail->getPathname();

        $product = Product::create([
            "name" => $request->name,
            "stock" => $request->stock,
            "category_id" => $request->category,
            "price" => $request->harga,
            "description" => $request->deskripsi,
            "thumbnail" => $thumbnailPath
        ]);
        
        alert()->success('Success', 'Success Add New Product!');


        return redirect()->route('kantin.addproduct.index');
    }


    public function editproduct(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('canteen.editproduct', compact('categories', 'product'));
    }


    public function deleteproduct(int $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back();
    }

    public function updateproduct(int $id, Request $request)
    {
        $imageThumbnail = "";

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $imageThumbnail = $request->file('image')->move("images/", $request->file('image')->getClientOriginalName() . now()->format('dmYHis') . $request->file('image')->getClientOriginalExtension());

            if (file_exists(public_path($product->thumbnail))) {
                if (!unlink(public_path($product->thumbnail))) {
                    Storage::delete($product->thumbnail);
                } else {
                    Storage::delete($product->thumbnail);
                }
            }
        }

        $updateData = [
          "name" => $request->name,
          "stock" => $request->stock,
          "category_id" => $request->category,
          "price" => $request->harga,
          "description" => $request->deskripsi
        ];

        if (!empty($imageThumbnail)) {
            $updateData["thumbnail"] = $imageThumbnail->getPathname();
        }

        $product->update($updateData);

           
        alert()->success('Success', 'Success Edit Product!');

        return redirect()->route('kantin.product.index');

    }

    public function transactionindex()
    {
        $transactions = Transaction::where('status', 'paid')->orWhere('status', 'taken')->orderBy('updated_at')->get()->groupBy('updated_at');
        return view('canteen.transaction', compact('transactions'));
    }

    public function print(string $date, string $user_id)
    {
        $user = User::find($user_id);
        $transactions = Transaction::where('user_id', $user_id)
            ->whereIn('status', ['paid', 'taken'])
            ->where('updated_at', urldecode($date))
            ->get();

        return view('canteen.print', compact('transactions','user'));
    }

}

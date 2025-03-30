<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('seasons')->paginate(6);
        return view('products', compact('products'));
    }

    public function register()
    {
                $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        //画像をアップロード
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img','public');
        }

        //productsテーブルに格納
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' =>$imagePath ?? null,
            'description' => $request->description,
        ]);

        //season_idを中間テーブルに格納
        $product->seasons()->attach($request->season_id);

        return redirect('/products');
    }
}

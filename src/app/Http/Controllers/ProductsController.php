<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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

    public function detail(Request $request){
        $product = Product::with('seasons')->find($request->id);
        $seasons = Season::all();

        return view('detail',compact('product', 'seasons'));
    }

    public function update(ProductRequest $request,$id)
    {
        $product = Product::findOrFail($id);

        //デフォルト値に現在の画像のファイルパスを設定
        $imagePath = $product->image;

        // 新しく画像ファイルが選択されている場合
        if ($request->hasFile('image')) {
        // 変更前の画像を削除
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
        }
        
        // 変更後の画像を保存
        $imagePath = $request->file('image')->store('img', 'public');
    }
    
        $product->update([
            'name' => $request->name,
            'price'=> $request->price,
            'description' => $request->description,
            'image'=> $imagePath
        ]);

        //season_idの紐付けと紐付け解除
        $product->seasons()->sync($request->season_id);

        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        $product = Product::with('seasons')->find($request->id);
        // 商品が存在し、画像パスが設定されている場合
        if ($product && $product->image)
        {
            // 画像ファイルが存在する場合は削除
            if (Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
        }

        // 商品を削除
        if ($product) {
            $product->delete();
        }

        return redirect('/products');
    }

    public function search(Request $request)
    {
        $query = Product::query();

        //検索機能
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->KeywordSearch($keyword);
            }

        // ソート機能
        if ($request->has('sort')) {
            $sortBy = $request->input('sort');
            if ($sortBy == 'high-to-low') {
                $query->orderBy('price', 'desc');
            } elseif ($sortBy == 'low-to-high') {
                $query->orderBy('price', 'asc');
            }
        }

        $products = $query->paginate(6);

        // ソートパラメータをページネーションに引き継ぐ
        $products->appends($request->all());

        return view('products', compact('products'));
    }
}

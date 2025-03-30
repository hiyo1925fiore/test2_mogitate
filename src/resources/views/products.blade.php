@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="products">
    <div class="products__heading">
        <h2 class="products__heading-title">商品一覧</h2>
        <a class="products__heading-link--register" href="/products/register">&plus;&nbsp;商品を追加</a>
    </div>

    <div class="products-list">
        <div class="products-list__tool">
            <form action="find" method="post">
                @csrf
                <div class="products-list__tool--search">
                    <input type="text" name="input" value="" placeholder="商品名を検索">
                    <input type="submit" value="検索">
                </div>
                <div class="products-list__tool--sort">
                    <select name="sort" class="form-select">
                        <option value="">価格で並び替え</option>
                        <option value="expensive">高い順に表示</option>
                        <option value="low">低い順に表示</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="products-list__inner">
            <table class="products-list__table">
                @foreach($products as $product)
                <tr class="products-list__row">
                    <p><a href="/products/{{ $product->id }}"><img class="products-list__img" src="{{ Storage::url($product->image) }}" alt="画像"></a></p>
                    <dl class="products-list__product-info">
                        <dt class="products-list__product--name"><a href="/products/{{ $product->id }}">{{ $product->name }}</a></dt>
                        <dd class="products-list__product--price">&yen;{{ $product->price }}</dd>
                    </dl>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
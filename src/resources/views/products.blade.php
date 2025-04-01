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
            <form class="search-form" action="/products/search" method="get">
                @csrf
                <div class="search-form__item">
                    <!-- 並び替え条件がある場合は維持 -->
                    @if(request()->has('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="商品名を検索">
                </div>
                <div class="search-form__button">
                    <button class="search-form__button" type="submit">検索</button>
                </div>
            </form>
            <div class="sort-select">
                <label>価格順で表示</label>
                <form action="/products/search" method="get">
                    <!-- 検索キーワードがある場合は維持 -->
                    @if(request()->has('keyword'))
                        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                    @endif
                    <select name="sort" class="price-sort" onchange="this.form.submit()">
                        <option value="" selected disabled>価格で並び替え</option>
                        <option value="high-to-low" {{ request('sort') == 'high-to-low' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low-to-high" {{ request('sort') == 'low-to-high' ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                </form>
            </div>
            <div class="sort-select__tag-container">
                @if(request()->has('sort'))
                    <div class="sort-select__tag">
                        {{ request('sort') == 'high-to-low' ? '高い順に表示' : '低い順に表示' }}
                        <a href="/products/search?{{ http_build_query(request()->except(['sort', 'page'])) }}" class="sort-tag-close">&times;</a>
                    </div>
                @endif
            </div>
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

        <div class="pagination-container">
            <ul class="pagination">
                {{-- 前へ --}}
                @if ($products->onFirstPage())
                    <li class="disabled"><span>&lt;</span></li>
                @else
                    <li><a href="{{ $products->previousPageUrl() }}" rel="prev">&lt;</a></li>
                @endif

                {{-- ページ番号 --}}
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if ($page == $products->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- 次へ --}}
                @if ($products->hasMorePages())
                    <li><a href="{{ $products->nextPageUrl() }}" rel="next">&gt;</a></li>
                @else
                    <li class="disabled"><span>&gt;</span></li>
                @endif
            </ul>
        </div>

    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="products">
    <div class="products__heading">
        <h2 class="products__heading-ttl">商品一覧</h2>
        <a class="products__heading-link--register" href="#">&plus;&nbsp;商品を追加</a>
    </div>
</div>
@endsection
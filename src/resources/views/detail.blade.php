@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="product-details">
    <form action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="product-details__content--except-description">
            <nav aria-label="商品一覧" class="product-details__breadcrumb">
                <ul class="product-details__breadcrumb-inner">
                    <li><a href="/products">商品一覧</a></li>
                    <li><span aria-current="page">{{ $product->name }}</span></li>
                </ul>
            </nav>

            <div class="product-details__inner">
                <div class="product-details__group">
                    <div class="product-details__image-preview">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; margin-bottom: 10px;">
                            <input type="hidden" name="current_image" value="{{ $product->image }}">
                            <div class="current-file-info">現在のファイル: {{ basename($product->image) }}</div>
                        @else
                            <img src="" alt="商品画像"  style="display: none;">
                        @endif
                    </div>
                    
                    <input class="product-details__file" type="file" name="image" id="image">
                    <p class="product-details__error-message">
                        @error('image')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="product-details__inner-input">
                    <div class="product-details__group">
                        <label class="product-details__label" for="name">商品名</label>
                        <input class="product-details__input" type="text" name="name" id="name" value="{{ $product->name }}" placeholder="商品名を入力">
                        <p class="product-details__error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="product-details__group">
                        <label class="product-details__label" for="price">値段</label>
                        <input class="product-details__input" type="text" name="price" id="price" value="{{ $product->price }}" placeholder="値段を入力">
                        <p class="product-details__error-message">
                            @error('price')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="product-details__group">
                        <label class="product-details__label">季節</label>
                        <div class="product-details__season-inputs">
                            @foreach($seasons as $season)
                            <div class="product-details__season-option">
                                <label class="product-details__season-label">
                                    <input class="product-details__season-input"
                                        type="checkbox"
                                        name="season_id[]"
                                        id="{{ strtolower($season->name) }}"
                                        value="{{ $season->id }}"
                                        {{in_array($season->id, $product->seasons->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <span class="product-details__season-text">{{ $season->name }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <p class="product-details__error-message">
                            @error('season_id')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-details__content--description">
            <div class="product-details__group">
                <label class="product-details__label" for="description">商品説明</label>
                <textarea class="product-details__textarea" name="description" id="" cols="30" rows="10" placeholder="商品の説明を入力">{{ $product->description }}</textarea>
                <p class="product-details__error-message">
                    @error('description')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <!-- 変更を保存するためidをhidden属性で渡す -->
             <input type="hidden" name="id" value="{{ $product['id'] }}">
        </div>

        <div class="product-details__button">
            <div class="product-details__button--back-and-update">
                <a class="product-details__back" href="/products">戻る</a>
                <input class="product-details__button--update" type="submit" value="変更を保存">
            </div>
        </div>
    </form>
    <form action="/products/{id}/delete" method="post">
        @method('DELETE')
        @csrf
        <input class="product-details__delete-item" type="hidden" name="id" value="{{ $product['id'] }}">
        <button type="submit" class="product-details__button--delete">削除</button>
    </form>
</div>
<!-- 選択した画像のプレビューを表示する -->
<script src="{{ asset('js/detail_preview_image.js') }}"></script>
@endsection
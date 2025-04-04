@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading">商品登録</h2>
    <div class="register-form__inner">
        <form action="/products/register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="register-form__group">
                <label class="register-form__label" for="name">
                    商品名<span class="register-form__required">必須</span>
                </label>
                <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力">
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="price">
                    値段<span class="register-form__required">必須</span>
                </label>
                <input class="register-form__input" type="text" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
                <p class="register-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="image">
                    商品画像<span class="register-form__required">必須</span>
                </label>

                <div class="register-form__image-upload-container">
                    <div class="register-form_image-preview-container" id="image-preview-container">
                    </div>

                    <div class="register-form__file-input-wrapper">
                        <input class="register-form__file" type="file" name="image" id="image" style="display: none;" accept="image/*">
                        <label for="image" class="register-form__file-select-button">ファイルを選択</label>
                        <span class="register-form__file-selected-name" id="file-selected-name"></span>
                    </div>
                </div>
                <p class="register-form__error-message">
                    @error('image')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="contact-form__label">
                    季節<span class="register-form__required">必須</span><span class="register-form__multiple_selection_possible">複数選択可</span>
                </label>
                <div class="register-form__season-inputs">
                    @foreach($seasons as $season)
                    <div class="register-form__season-option">
                        <label class="register-form__season-label">
                            <input class="register-form__season-input" type="checkbox" name="season_id[]" id="{{ strtolower($season->name) }}" value="{{ $season->id }}" {{in_array($season->id,old('season_id',[])) ? 'checked' : '' }}>
                            <span class="register-form__season-text">{{ $season->name }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                <p class="contact-form__error-message">
                    @error('season_id')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="description">
                    商品説明<span class="register-form__required">必須</span>
                </label>
                <textarea class="register-form__textarea" name="description" id="" cols="30" rows="10" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <p class="register-form__error-message">
                    @error('description')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <a class="register-form__back" href="/products">戻る</a>
            <input class="register-form__register-button" type="submit" value="登録">
        </form>
    </div>
</div>
<!-- 選択した画像のプレビュー＆画像選択時のみ画像名を表示する -->
<script src="{{ asset('js/register_preview_image.js') }}"></script>

@endsection
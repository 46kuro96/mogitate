@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register__heading">
        <h2>商品登録</h2>
    </div>
    <form action="/products" method="post" enctype="multipart/form-data" class="register__form">
        @csrf
        <div class="register__group">
            <label for="name" class="register__label">
                商品名<span class="register__required">必須</span>
            </label>
            <input type="text" class="register__input" name="name" placeholder="商品名を入力">
            <div class="register-form__error-message">
                @error('name')
                <p class="register-form__error-message-name">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="register__group">
            <label for="price" class="register__label">
                値段<span class="register__required">必須</span>
            </label>
            <input type="text" class="register__input" name="price" placeholder="値段を入力">
        <div class="register-form__error-message">
            @error('price')
            <p class="register-form__error-message-price">{{ $message }}</p>
            @enderror
        </div>
</div>
        <div class="register__group">
            <label for="" class="register__label">
            商品画像<span class="register__required">必須</span>
            </label>
            <input type="file" name="image" id="imageUpload" class="register__image-input" accept="image/*" />
            <img id="preview" class="register__image-preview" />
            <script>
                const imageUpload = document.getElementById('imageUpload');
                const preview = document.getElementById('preview');

                imageUpload.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            </script>
        <div class="register-form__error-message">
            @error('image')
            <p class="register-form__error-message-image">{{ $message }}</p>
            @enderror
        </div>
            </div>
        <div class="register__group">
            <label for="" class="register__label">
                季節<span class="register__required">必須</span>
                <span class="register__required-repletion">複数選択可</span>
            </label>
            <div class="register__season-content">
                @php
                    $seasonLabels = [
                        ['id' => 1, 'name' => '春'],
                        ['id' => 2, 'name' => '夏'],
                        ['id' => 3, 'name' => '秋'],
                        ['id' => 4, 'name' => '冬'],
                    ];
                @endphp
                @foreach ($seasonLabels as $season)
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="{{ $season['id'] }}" />
                        <span class="checkbox-style"></span>
                        {{ $season['name'] }}
                    </label>
                @endforeach
        </div>
        <div class="register-form__error-message">
            @error('season')
            <p class="register-form__error-message-season">{{ $message }}</p>
            @enderror
        </div>
                </div>
        <div class="register__group">
            <label for="detail" class="register__label">
                商品説明<span class="register__required">必須</span>
            </label>
            <textarea name="description" id="" class="register__description" placeholder="商品の説明を入力"></textarea>
        <div class="register-form__error-message">
            @error('description')
            <p class="register-form__error-message-description">{{ $message }}</p>
            @enderror
        </div>
                </div>
        <div class="register__button">
            <button class="register__button-submit-back" type="button" onclick="location.href='/products' ">戻る</button>
            <button class="register__button-submit-register" type="submit">登録</button>
        </div>
    </form>
</div>
    @endsection

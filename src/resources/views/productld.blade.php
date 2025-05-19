@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/productld.css') }}">
@endsection

@section('content')
<div class="productld__content">
        <div class="productld__record"><a class="productld__record-link" href="/products">商品一覧</a>> {{ $product->name }}</div>
        <form class="productld__detail" action="/products/{{ $product->id }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="productld__group">
                        <div class="productld__file">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%; height: auto;">
                                <label class="productld__image" for="imageUpload"></label>
                                <input class="productld__image-file" type="file" name="image" id="imageUpload">
                                <input type="hidden" name="id" value="{{ $product['id'] }}">
                                <span class="file-info"></span>
                                <div class="productld-form__error-message">
                                        @error('image')
                                        <p class="productld-form__error-message-image">{{ $message }}</p>
                                        @enderror
                                </div>
                        </div>
                        <div class="productld__name">
                                <label for="name" class="productld__label">商品名</label>
                                <input type="text" class="productld__input" name="name" id="name" value="{{ $product['name'] }}">
                                <input type="hidden" name="id" value="{{ $product['id'] }}">
                                <div class="productld-form__error-message">
                                        @error('name')
                                        <p class="productld-form__error-message-name">{{ $message }}</p>
                                        @enderror
                                </div>
                        </div>
                        <div class="productld__price">
                                <label for="price" class="productld__label">値段</label>
                                <input type="text" class="productld__input" name="price" id="price" value="{{ $product['price'] }}">
                                <input type="hidden" name="id" value="{{ $product['id'] }}">
                        <div class="productld-form__error-message">
                                        @error('price')
                                        <p class="productld-form__error-message-price">{{ $message }}</p>
                                        @enderror
                                </div>
                        </div>
                        <div class="productld__season">
                                <label for="season" class="productld__label">季節</label>
                                <div class="productld__season-content">
                                @foreach ($seasons as $season)
                                <label class="custom-checkbox">
                                        <input type="checkbox" name="season[]" value="{{ $season->id }}"
                                        {{ in_array($season->id, $product->seasons->pluck('id')->toArray()) ? 'checked' : '' }} />
                                        <span class="checkbox-style"></span>
                                {{ $season->name }}
                                </label>
                                @endforeach
                                </div>
                                <div class="productld-form__error-message">
                                        @error('season')
                                        <p class="productld-form__error-message-season">{{ $message }}</p>
                                        @enderror
                                </div>
                        </div>
                </div>
                <div class="productld__description">
                        <label for="description" class="productld__label">商品説明</label>
                        <textarea class="productld__input-text" name="description" id="description" >{{ $product->description }}</textarea>
                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                        <div class="productld-form__error-message">
                                @error('description')
                                <p class="productld-form__error-message-description">{{ $message }}</p>
                                @enderror
                        </div>
                </div>
                <div class="productld__button">
                        <button class="productld__button-back" type="button" onclick="location.href='/products'">戻る</button>
                        <button class="productld__button-submit" type="submit">変更を保存</button>
                </div>
        </form>
        <form class="delete-form" action="{{ route('products.delete', ['id' => $product->id]) }}" method="post">
                @method('delete')
                @csrf
                <button class="productld__button-delete" type="submit" title="delete">&#128465;</button>
        </form>
</div>
@endsection
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="products__content">
    <form class="products-form" action="products/register" method="post" >
        @csrf
        <div class="products-form__heading">
            <h2>商品一覧</h2>
        </div>
        <div class="products-form__link">
            <a href="/products/register" class="products-form__link-submit">+ 商品追加</a>
        </div>
    </form>
    <div class=products__container>
        <aside class="products-aside">
            <div class="products-aside__content">
                <form action="{{ route('products.search') }}" method="get" class="products-aside__form">
                    @csrf
                    <div class="products-aside__form-group">
                        <label for="keyword" class="products-aside__form-label"></label>
                        <input class="products-aside__form-input" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}" />
                    </div>
                    <div class="products-aside__button">
                        <button class="products-aside__button-input" type="submit">検索</button>
                    </div>
                    <div class="products-aside__form-group">
                        <label for="price" class="products-aside__form-label">
                            <h3 class=products-aside__form-price>価格順で表示</h3>
                            <a href="/search" class="reset-button" >×</a>
                        </label>
                        <select class="products-aside__form-select" name="price" id="price">
                            <option value="asc" {{ old('price') == 'asc' ? 'selected' : '' }}>高い順に表示</option>
                            <option value="desc" {{ old('price') == 'desc' ? 'selected' : '' }}>低い順に表示</option>
                        </select>
                    </div>
                </form>
            </div>
        </aside>
        <div class="products__list">
            <div class="products__list-image">
                @foreach ($products as $product)
                    <div class="products__item">
                        <a href="{{ route('productld', ['id' => $product->id]) }}" >
                            <img class="products__item-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </a>
                        <div class="products__item-name-price">
                            <div class="products__item-name">
                                <p>{{ $product->name }}</p>
                            </div>
                            <div class="products__item-price">
                                <p>¥{{ number_format($product->price) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="pagination">
    {{ $products->links() }}
</div>
@endsection



<?php

namespace App\Http\Controllers;

use App\Http\Requests\MogitateRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\Product_Season;

class MogitateController extends Controller
{
    public function products()
    {
        $products = Product::all();
        $products = Product::Paginate(6);
        return view('products', compact('products'));
    }

    public function register()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function store(MogitateRequest $request)
    {
        $data = $request->only([
            'name',
            'price',
            'description']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }
            $product = Product::create(
            $data
            );

        $product->seasons()->attach($request->input('seasons', []));

        return redirect('/products');
    }

    public function productld($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        return view('productld', compact('product', 'seasons'));
    }

    public function update(MogitateRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // 新しい画像保存 //
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        // 季節の更新 //
        $product->seasons()->sync($request->input('season', []));

        return redirect('/products');
    }

    public function destroy(MogitateRequest $request,$id)
    {
        $product = Product::findOrFail($id);
        $product->seasons()->detach();  // 中間テーブルの削除
        $product->delete();


        return redirect('/products');
    }

    public function search(MogitateRequest $request)
    {
        $query = Product::query();
        // キーワード
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        // 価格
        if ($request->filled('price')) {
            $sort = $request->input('price');
            if ($sort === 'asc') {
                $query->orderBy('price', 'desc'); // 高い順
                } elseif ($sort === 'desc') {
                $query->orderBy('price', 'asc'); // 低い順
            }
        }

        $products = $query->paginate(6)->appends($request->all());

        return view('products', compact('products'));
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description'
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }

    public function scopeCategorySearch($query, $product_id)
{
  if (!empty($product_id)) {
    $query->where('product_id', $product_id);
  }
}

public function scopeKeywordSearch($query, $keyword)
{
  if (!empty($keyword)) {
    $query->where('content', 'like', '%' . $keyword . '%');
  }
}

}

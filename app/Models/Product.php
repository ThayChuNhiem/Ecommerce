<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Shop;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable 
    = ['name', 'description','price','image','status','shop_id','category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop');
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    public function productStocks()
    {
        return $this->hasMany(ProductStock::class);
    }
}

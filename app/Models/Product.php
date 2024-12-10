<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable 
    = ['name', 'description','price','image','status','shop','category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

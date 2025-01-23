<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'is_active',
        'image',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return 'storage/products/' . $this->image;
        } else {
            return "https://dummyimage.com/700x350/dee2e6/6c757d.jpg";
        }
    }
}

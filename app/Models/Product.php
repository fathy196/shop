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
    // Method to get related products
    public function relatedProducts()
    {
        return $this->category->products()
            ->where('id', '!=', $this->id) // Exclude the current product
            // ->inRandomOrder() // Randomize the results
            // ->limit(8) // Limit to 4 related products
            ->paginate(4);
    }

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return 'storage/products/' . $this->image;
        } else {
            return "https://dummyimage.com/700x350/dee2e6/6c757d.jpg";
        }
    }
    public function getIsActiveStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }
}

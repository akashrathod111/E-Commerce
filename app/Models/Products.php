<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'cat_id',
        'vendor_id',
        'name',
        'description',
        'price',
        'image_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}

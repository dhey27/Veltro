<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // ✅ Izinkan mass assignment untuk kolom berikut
    protected $fillable = [
        'name',
        'price',
        'stock',
        'size',
        'description',
        'image',
    ];

    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

}

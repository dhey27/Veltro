<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;

class Order extends Model
{
    /**
     * Atribut yang boleh diisi secara massal (fillable).
     */
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'status',
        'total_price',
        'payment_proof',
    ];

    /**
     * Relasi: Satu pesanan memiliki banyak item.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relasi: Satu pesanan dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

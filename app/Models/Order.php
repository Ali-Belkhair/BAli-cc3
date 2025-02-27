<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'order_date',
    ];

    // Many-to-One relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Many-to-Many relationship with Product
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

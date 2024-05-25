<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable  = [ 'name' , 'price' , 'description' , 'image' , 'categorie_id'] ;

    
    // Many-to-One relationship with Category
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    // Many-to-Many relationship with Order (through pivot table order_product)
    public function orders()
    {
        return $this->belongsToMany(Order::class); 
    }

}

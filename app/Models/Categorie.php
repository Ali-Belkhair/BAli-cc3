<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product ;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory; 
    protected $fillable = ['name'] ;
   
    public function products(): HasMany
    {
        return $this->hasMany(Product::class ); 
    }
}

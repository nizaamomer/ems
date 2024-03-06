<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function material(){
        return $this->belongsTo(Material::class);
    }
    public function scopeOfSearch($query, $search)
    {
        if ($search !== null) {
            return $query->where(function ($query) use ($search) {
                $query->where('code', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }
        return $query;
    }
}

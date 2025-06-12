<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Scope to filter active items
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope to search items by name or price
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($term) . '%'])
              ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($term) . '%']);
        });
    }
}

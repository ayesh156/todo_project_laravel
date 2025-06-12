<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'status'];

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

    public static function createForUser($userId, $data)
    {
        return self::create([
            'user_id' => 27,
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'] ?? 0,
        ]);
    }
}

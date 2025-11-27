<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'category' // Tetap ada tapi selalu 'T-Shirt'
    ];

    // Relationship dengan CartItem
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relationship dengan OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
    }

    // Accessor untuk format price
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    // Method untuk cek stock
    public function inStock()
    {
        return $this->stock > 0;
    }

    // Method untuk decrease stock
    public function decreaseStock($quantity)
    {
        $this->decrement('stock', $quantity);
    }

    // Method untuk increase stock
    public function increaseStock($quantity)
    {
        $this->increment('stock', $quantity);
    }

    // Total sold count
    public function getTotalSoldAttribute()
    {
        return $this->orderItems()->sum('quantity');
    }

    // Total revenue from this product
    public function getTotalRevenueAttribute()
    {
        return $this->orderItems()->sum('total_price');
    }

    public function getFormattedTotalRevenueAttribute()
    {
        return '$' . number_format($this->total_revenue, 2);
    }
}
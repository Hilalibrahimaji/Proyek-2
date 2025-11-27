<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\CartItems;
use App\Models\Order;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'city',
        'postal_code',
        'country',
        'birth_date',
        'gender'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Relationship dengan CartItem
    public function CartItem()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relationship dengan Order
    public function Order()
    {
        return $this->hasMany(Order::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function getCartCountAttribute()
    {
        return $this->CartItem()->count();
    }

    public function getOrdersCountAttribute()
    {
        return $this->orders()->count();
    }

    public function getTotalSpentAttribute()
    {
        return $this->orders()->where('payment_status', 'paid')->sum('total');
    }

    public function getFormattedTotalSpentAttribute()
    {
        return '$' . number_format($this->total_spent, 2);
    }

    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function getFormattedPhoneAttribute()
    {
        return $this->phone ?: 'Not set';
    }

    public function getFormattedAddressAttribute()
    {
        if ($this->address && $this->city && $this->postal_code) {
            return "{$this->address}, {$this->city}, {$this->postal_code}";
        }
        return 'Not set';
    }

    public function getProfileCompletionAttribute()
    {
        $fields = ['name', 'email', 'phone', 'address', 'city', 'country'];
        $completed = 0;
        
        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $completed++;
            }
        }
        
        return round(($completed / count($fields)) * 100);
    }
}
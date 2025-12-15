<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\CartItem;
use App\Models\Order;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

     protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'address',
        'city',
        'postal_code',
        'country',
        'birth_date',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
    ];


    // Relationship dengan CartItem (perbaiki typo)
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relationship dengan Order
    public function orders()
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
        return $this->cartItems()->count();
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
        return 'Rp ' . number_format($this->total_spent, 0, ',', '.');
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

    // Tambahkan method untuk avatar URL
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/avatars/' . $this->avatar);
        }
        return asset('images/default-avatar.png');
    }

    public function getDisplayAvatarAttribute()
{
    if ($this->avatar) {
        return '<img src="' . $this->avatar_url . '" alt="' . $this->name . '" class="w-8 h-8 rounded-full object-cover">';
    }
    return '<div class="w-8 h-8 bg-[#10a2a2] rounded-full flex items-center justify-center text-white font-semibold">' 
           . strtoupper(substr($this->name, 0, 1)) . '</div>';
}
}


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

    // ======================
    // FIX UTAMA DI SINI
    // ======================
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar', // ✔ WAJIB avatar, BUKAN photo
        'phone',
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
        'birth_date' => 'date',
    ];

    // ======================
    // RELATIONSHIPS
    // ======================
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // ======================
    // HELPERS
    // ======================
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

    // ======================
    // AVATAR ACCESSOR (FINAL)
    // ======================
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/avatars/' . $this->avatar);
        }

        return asset('images/default-avatar.png');
    }
}

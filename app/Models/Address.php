<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    protected $fillable = [
        'user_id',
        'address',
        'city',
        'district',
        'commune',
        'is_default'
    ];

    public function getFullAddressAttribute()
    {
        return $this->address . ', ' . $this->commune . ' Commune, ' . $this->district . ' District, ' . $this->city;
    }
}

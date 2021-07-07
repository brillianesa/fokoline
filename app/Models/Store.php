<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'address', 'image', 'latitude', 'longitude', 'phone_number', 'payment_list'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getListStore($user)
    {
        return Store::select('id')->where('user_id', $user->id)->get();
    }

    public function prices()
    {
        return $this->hasMany(StorePrice::class);
    }
}

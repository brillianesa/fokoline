<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'bank', 'rekening_number', 'address', 'image', 'latitude', 'longitude'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}

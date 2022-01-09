<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bid;
use App\Models\User;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'bid_price',
        'payment',
        'delivery',
        'image',
        'user_id',
        'end_time',
        'buyer_id',
        'active',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'user_id');
    }

    public function offers()
    {
        return $this->hasMany(Bid::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
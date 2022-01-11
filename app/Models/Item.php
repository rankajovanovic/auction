<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bid;
use App\Models\User;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Item extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'user_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
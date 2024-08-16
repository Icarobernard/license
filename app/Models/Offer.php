<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'type',
        'licenses',
        'subscription_type',
        'subscription_quantity',
        'is_visible',
        'utm_source',
        'utm_campaign',
        'utm_medium',
        'utm_term',
        'utm_content',
        'url',
        'price',
        'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

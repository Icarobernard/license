<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'payment_type', 'product_id', 'update_id', 'unlimited_subdomain_id', 'support_id', 'image', 'is_free', 'rank', 'custom_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contents()
    {
        return $this->hasMany(Content::class, 'product_id');
    }
}

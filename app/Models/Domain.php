<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'license_id',
        'is_subdomain',
        'parent_id'
    ];
    public function subdomains()
    {
        return $this->hasMany(Domain::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Domain::class, 'parent_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}

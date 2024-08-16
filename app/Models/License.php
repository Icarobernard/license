<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    protected $fillable = [
        'license_key',
        'license_name',
        'transaction',
        'subscriber_code',
        'status',
        'expiration_date',
        'email',
        'client_name',
        'offer_id',
        'verification_code',
        'total_amount'
    ];
}

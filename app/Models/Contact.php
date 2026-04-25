<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'whatsapp_number',
        'whatsapp_message',
        'address',
        'maps_embed',
        'delivery_info',
        'parking_info',
        'is_active'
    ];
}
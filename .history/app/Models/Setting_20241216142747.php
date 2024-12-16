<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Allow mass assignment for specific fields
    protected $fillable = [
        'key',
        'value',
    ];


    use HasFactory;

    protected $fillable = ['title', 'links'];

}

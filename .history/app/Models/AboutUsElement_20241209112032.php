<?php

namespace App\Models;
se Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsElement extends Model
{
    use HasFactory;

    protected $fillable = ['element', 'data'];
}

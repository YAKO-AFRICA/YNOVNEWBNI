<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteWeb extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'url',
        'description',
        'username',
        'password',
        'etat',
    ];
}

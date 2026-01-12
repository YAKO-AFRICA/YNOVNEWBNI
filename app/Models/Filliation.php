<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filliation extends Model
{
    use HasFactory;

    protected $table = 'tblfiliation';

    protected $fillable = [
        'IdFiliation',
        'CodeFiliation',
        'MonLibelle',
        'ID_Old'
    ];
}

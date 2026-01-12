<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'adherent_id',
        'type',
        'valeur',
        'principal',
        'etat',
    ];
}
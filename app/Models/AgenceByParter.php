<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgenceByParter extends Model
{
    use HasFactory;
    protected $table = 'agence_by_parters';

    protected $fillable = [
        'id',
        'codeAgnce',
        'libelle',
        'codeBanque',
        'codePartner',
    ];

}

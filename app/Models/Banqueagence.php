<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banqueagence extends Model
{
    use HasFactory;

    protected $table = 'tblbanqueagence';

    public $timestamps = false;
    
    protected $fillable = [
        'CODEBANQUE',
        'CODEBCEAO',
        'CodeGuichet',
        'SIGLE',
        'NOM_LONG',
        'LOCALISATION',
        'ID_Old'
    ];

}

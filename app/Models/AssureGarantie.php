<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssureGarantie extends Model
{
    use HasFactory;

    protected $table = 'tblassuregaranties';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'codeproduitgarantie',
        'idproduitparantie',
        'monlibelle',
        'prime',
        'primetotal',
        'primeaccesoire',
        'type',
        'capitalgarantie',
        'tauxinteret',
        'codeassure',
        'codecontrat',
        'estmigre',
        'refcontratsource',
        'cleintegration',
    ];
}

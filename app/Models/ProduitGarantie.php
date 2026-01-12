<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitGarantie extends Model
{
    use HasFactory;

    protected $table = 'tblgaranties';

    public $timestamps = false;

    protected $fillable = [
        'codeproduit',
        'codeproduitgarantie',
        'libelle',
        'estobligatoire',
        'naturegarantie',
        'type',
        'taux',
        'montantgarantie',
        'agemin',
        'agemax',
        'dureecotisationmin',
        'dureecotisationmax',
        'dureecontratmin',
        'dureecontratmax',
        'primemin',
        'branche',
        'description',
        'estunique',
        'estcomplementaire'
    ];

}

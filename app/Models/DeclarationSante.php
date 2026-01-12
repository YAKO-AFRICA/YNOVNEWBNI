<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeclarationSante extends Model
{
    use HasFactory;

    protected $table = 'declaration_santes';

    protected $fillable = [
        'taille',
        'poids',
        'tensionMin',
        'tensionMax',
        'smoking',
        'alcohol',
        'sport',
        'accident',
        'treatment', // trantement medical 6 dernier mois
        'transSang', // transfusion de sang 6 dernier mois
        'interChirugiale', // intervention chirurgicaledeja subit
        'prochaineInterChirugiale', // intervention chirurgicale prochaine
        'diabetes',
        'hypertension',
        'sickleCell',
        'liverCirrhosis',
        'lungDisease',
        'cancer',
        'anemia',
        'kidneyFailure',
        'stroke',
        'codePret',
        'codeContrat',
        'created_at',
        'updated_at'
    ];
}

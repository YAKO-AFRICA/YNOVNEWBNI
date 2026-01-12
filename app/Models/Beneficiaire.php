<?php

namespace App\Models;

use App\Models\Contrat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beneficiaire extends Model
{
    use HasFactory;

    protected $table = 'tblbeneficiaire';

    public $timestamps = false;

    protected $fillable = [
        'civilite',
        'nom',
        'prenom',
        'datenaissance',
        'lieunaissance',
        'filiation',
        'estmigre',
        'codecontrat',
        'codeadherent',
        'sexe',
        'numeropiece',
        'naturepiece',
        'lieuresidence',
        'profession',
        'employeur',
        'pays',
        'email',
        'bp',
        'telephone',
        'telephone1',
        'mobile',
        'mobile1',
        'saisieLe',
        'saisiepar',
        'refcontratsource',
        'cleintegration',
        'type',
        'part',
        'source',
        'id_maj',
        'connexe',
        'codepret'
    ];
    public function contrat()
    {
        return $this->belongsTo(Contrat::class, 'codecontrat', 'id');
    }
}

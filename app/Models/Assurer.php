<?php

namespace App\Models;

use App\Models\Contrat;
use App\Models\AssureGarantie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assurer extends Model
{
    use HasFactory;

    protected $table = 'tblassure';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'civilite',
        'nom',
        'prenom',
        'datenaissance',
        'codecontrat',
        'codeadherent',
        'lieunaissance',
        'filiation',
        'estmigre',
        'sexe',
        'numeropiece',
        'naturepiece',
        'lieuresidence',
        'part',
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
        'modifierle',
        'modifierpar',
        'refcontratsource',
        'cleintegration',
        'id_maj',
        'isinc',
        'codeoperation',
    ];
    public function contrat()
    {
        return $this->belongsTo(Contrat::class, 'codecontrat', 'id');
    }

    public function garanties()
    {
        return $this->hasMany(AssureGarantie::class, 'codeassure', 'id');
    }

    // public function sante()
    // {
    //     return $this->belongsTo(SanteAssur::class, 'id', 'codeAssur');
    // }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Zone;
use App\Models\Equipe;
use App\Models\Reseau;
use App\Models\Partner;
use App\Models\MembreContrat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membre extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'membre';

    protected $primaryKey = 'idmembre';

    public $incrementing = true;

    protected $fillable = [
        'idmembre',
        'id_session',
        'nom',
        'prenom',
        'cel',
        'tel',
        'pays',
        'ville',
        'email',
        'login',
        'pass',
        'date',
        'datemodif',
        'token',
        'enligne',
        'lastvisite',
        'nbrevisite',
        'memberok',
        'droits',
        'navigation_securise',
        'photo',
        'codeagent',
        'typ_membre',
        'activer',
        'branche',
        'partenaire',
        'codepartenaire',
        'agence',
        'datenaissance',
        'lieuresidence',
        'lieunaissance',
        'profession',
        'codereseau',
        'codezone',
        'codeequipe',
        'role',
        'coderole',
        'sexe',
        'cel2',
        'nomagence',
        'passmodifier',
        'passmodifierle',
        'estajour',
        'datevalidite',
        'paiementok',
        'lastpaiement',
        'devis',
        'isemploye',
        'isbranmaster',
        'ispartmaster',
        'isadmin',
        'user_parent',
        'updated_by',
        'created_by'
    ];

    public $timestamps = false;

    public function partenaire()
    {
        return $this->belongsTo(Partner::class, 'codepartenaire');
    }

    public function reseau()
    {
        return $this->belongsTo(Reseau::class, 'codereseau');
    }
    public function equipe()
    {
        return $this->belongsTo(Equipe::class, 'codeequipe', 'id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'codezone', 'id');
    }
    public function membreContrat()
    {
        return $this->hasMany(MembreContrat::class, 'codemembre', 'idmembre');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idmembre', 'idmembre');
    }
}

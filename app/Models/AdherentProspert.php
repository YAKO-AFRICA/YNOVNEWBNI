<?php

namespace App\Models;

use App\Models\Membre;
use App\Models\AssuranceInfo;
use App\Models\SuivieProspert;
use App\Models\PartnerProspert;
use App\Models\ProductProspert;
use App\Models\DocumentProspert;
use App\Models\ProspectFollowup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdherentProspert extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;
    protected $connection = 'mysql3';

    protected $table = 'adherent_prosperts';

    protected $fillable = [
        'uuid',
        'code',
        'civilite',
        'nom',
        'prenom',
        'genre',
        'date_naissance',
        'lieu_naissance',
        'lieu_residence',
        'situation_matrimoniale',
        'type_piece_identite',
        'numero_piece_identite',
        'email',
        'adresse',
        'pays',
        'profession',
        'employeur',
        'secteur_activite',
        'personneRessource',
        'contactRessource',
        'personneRessource2',
        'contactRessource2',
        'notes',
        'reference_par', // code de l'agent qui a cree le prospect
    ];

    public function contacts()
    {
        return $this->hasMany(ContactProspert::class, 'prospert_uuid', 'uuid');
    }

    public function agentCom()
    {
        return $this->belongsTo(Membre::class, 'reference_par', 'idmembre');
    }

    public function PartnerProspert()
    {
        return $this->hasMany(PartnerProspert::class, 'prospert_uuid', 'uuid');
    }

    public function products()
    {
        return $this->hasMany(ProductProspert::class, 'prospert_uuid', 'uuid');
    }


    public function assuranceInfo()
    {
        return $this->hasOne(AssuranceInfo::class, 'prospert_uuid', 'uuid');
    }

    public function documents()
    {
        return $this->hasMany(DocumentProspert::class, 'prospert_uuid', 'uuid');
    }

 

     public function followups()
    {
        return $this->hasMany(SuivieProspert::class, 'prospect_uuid', 'uuid')->orderBy('followup_date', 'desc');
    }
}

<?php

namespace App\Models;

use App\Models\Membre;
use App\Models\Tblotp;
use App\Models\TblDocPrestation;
use App\Models\TblMotifrejetbyprestat;
use App\Models\TblMotifrejetprestation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblPrestation extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tbl_prestations';
    protected $fillable = [
        'code',
        'idOtp',
        'idcontrat',
        'typeprestation',
        'prestationlibelle',
        'idclient',
        'nom',
        'prenom',
        'datenaissance',
        'lieunaissance',
        'sexe',
        'cel',
        'tel',
        'email',
        'msgClient',
        'lieuresidence',
        'montantSouhaite',
        'moyenPaiement',
        'Operateur',
        'telPaiement',
        'codeBanque',
        'codeGuichet',
        'numCompte',
        'cleRIB',
        'IBAN',
        'saisiepar',
        'traiterpar',
        'observationtraitement',
        'estMigree',
        'envoimail',
        'villedeclaration',
        'codemotifrejet',
        'mailtraitement',
        'etape',
        'etat'
    ];
    
    public function docPrestation()
    {
        return $this->hasMany(TblDocPrestation::class, 'idPrestation', 'id');
    }
    public function otp()
    {
        return $this->belongsTo(Tblotp::class, 'idOtp', 'id');
    }
    // public function contrat()
    // {
    //     return $this->belongsTo(TblContrat::class, 'idcontrat', 'id');
    // }
    public function membre()
    {
        return $this->belongsTo(Membre::class, 'saisiepar', 'idmembre');
    }
    public function membreClient()
    {
        return $this->belongsTo(Membre::class, 'idclient', 'idmembre');
    }
    public function motifrejet()
    {
        return $this->hasMany(TblMotifrejetbyprestat::class, 'codeprestation', 'code');
    }
}

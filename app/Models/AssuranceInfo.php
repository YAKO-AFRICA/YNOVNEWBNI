<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssuranceInfo extends Model
{
    use HasFactory;

    protected $table = 'assurance_infos';
    protected $connection = 'mysql3';

    protected $fillable = [
        'uuid',
        'code',
        'dejaClient',
        'assurerAuTerme',
        'produit_uuid',
        'datteEffet',
        'modePaiement',
        'periodicite',
        'signature',
        'duree',
        'prospert_uuid',
        'banque',
        'rib',
        'codeBanque',
        'codeGuichet',
        'numeroCompte',
        'cleRib'
    ];
}
<?php

namespace App\Models;

use App\Models\AdherentProspert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerProspert extends Model
{
    use HasFactory;

    protected $table = 'partner_prosperts';
    protected $connection = 'mysql3';

    protected $fillable = [
        'uuid',
        'code',
        'nom',
        'prenom',
        'genre',
        'civilite',
        'naturepiece',
        'numeropiece',
        'email',
        'situationMatrimoniale',
        'dateNaissance',
        'lieuNaissance',
        'lieuResidence',
        'adresseComplete',
        'profession',
        'employeur',
        'mobile',
        'prospert_uuid',
        'filliation_code',
        'code_partner',
    ];

    public function prospert()
    {
        return $this->belongsTo(AdherentProspert::class, 'prospert_uuid', 'uuid');
    }
}

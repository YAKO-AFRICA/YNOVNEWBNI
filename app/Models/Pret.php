<?php

namespace App\Models;

use App\Models\User;
use App\Models\Adherent;
use App\Models\Document;
use App\Models\Beneficiaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pret extends Model
{
    use HasFactory;

    protected $table = 'tblprets';

    public $timestamps = false;

    protected $fillable = [
        'typepret',
        'effetgarantie',
        'montantpret',
        'dateecheancedebut',
        'dateecheancefin',
        'remboursement',
        'txprimeunique',
        'numerocompte',
        'txsurprime',
        'txprimedef',
        'prime',
        'primeht',
        'montantsurprime',
        'fraisaccessoires',
        'fraismedicaux',
        'duree',
        'taille',
        'partenaire',
        'poids',
        'periodicite',
        'tension',
        'fumezvous',
        'nbcigarettejour',
        'buvezvous',
        'distraction',
        'estinfirme',
        'natureinfirmite',
        'estenarrettravail',
        'datearrettravail',
        'motifarret',
        'datereprisetravail',
        'causearrettravail',
        'datecausetravail',
        'saisiele',
        'saisiepar',
        'codeagent',
        'nomagent',
        'encotation',
        'etat',
        'codeadherent',
        'estmigre',
        'examens',
        'codebanque',
        'codeguichet',
        'agence',
        'tarificationmedicale',
        'datemiseenplace',
        'misenplacepar',
        'daterejet',
        'rejeterpar',
        'referencepret',
        'moftifrejet',
        'modifiele',
        'modifierpar',
        'primeobseque',
        'motifcotation',
        'capital',
        'beneficiaireaudeces',
        'personneressource',
        'contactpersonneressource',
        'personneressource2',
        'contactpersonneressource2',
        'rib',
        'estsportif',
        'sportpratique',
        'miseenplaceeffective',
        'motifrachat',
        'daterachat',
        'racheterpar',
        'medecin',
        'rapportmedicalok',
        'daterapportmedical',
        'primerisque',
        'primeemprunteur',
        'numeroclient',
        'typeadherent',
        'nbadherent',
        'unableyako',
        'rmedicinok',
        'datermedecin',
        'daterapport',
        'dateemis',
        'naturepret',
        'daterejetmedecin',
        'etatmedicin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'saisiepar', 'idmembre');
    }

    public function adherent()
    {
        return $this->belongsTo(Adherent::class, 'codeadherent', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'codecontrat', 'id');
    }

    public function beneficiaires()
    {
        return $this->hasMany(Beneficiaire::class, 'codecontrat', 'id');
    }

    public function assures()
    {
        return $this->hasMany(Assurer::class, 'codecontrat', 'id');
    }
    
}

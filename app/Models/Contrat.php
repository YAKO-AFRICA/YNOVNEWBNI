<?php

namespace App\Models;

use App\Models\User;
use App\Models\Membre;
use App\Models\Assurer;
use App\Models\Product;
use App\Models\Adherent;
use App\Models\Document;
use App\Models\Beneficiaire;
use App\Models\AgenceByParter;
use App\Models\AssureGarantie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrat extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'tblcontrat';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'dateeffet',
        'modepaiement',
        'organisme',
        'prime',
        'primepricipale',
        'surprime',
        'capital',
        'etape',
        'numerocompte',

        'agence',
        'saisiele',
        'saisiepar',
        'codeConseiller',
        'nomagent',
        'duree',
        'periodicite',
        'codeadherent',
        'estMigre',
        'codeproduit',

        'transmisle',
        'annulerle',
        'accepterle',
        'modifierle',
        'modifierpar',
        'motifrejet',
        'libelleproduit',
        'montantrente',
        'periodiciterente',
        'dureerente',

        'personneressource',
        'contactpersonneressource',
        'beneficiaireauterme',
        'beneficiaireaudeces',
        'accepterpar',
        'rejeterpar',
        'transmispar',
        'personneressource2',
        'contactpersonneressource2',
        'codebanque',
        'codeguichet',
        'rib',
        'idproposition',
        'codeproposition',
        'branche',

        'partenaire',
        'nomaccepterpar',
        'refcontratsource',
        'cleintegration',
        'codeoperation',
        'numeropolice',
        'fraisadhesion',
        'estpaye',
        'pretconnexe',
        'details',
        'nomsouscipteur',
        'typesouscipteur',
        'numBullettin',
        'Formule'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'saisiepar', 'idmembre');
    }

    public function adherent()
    {
        return $this->belongsTo(Adherent::class, 'codeadherent', 'id');
    }
    public function produit()
    {
        return $this->belongsTo(Product::class, 'codeproduit', 'CodeProduit');
    }
    public function assures()
    {
        return $this->hasMany(Assurer::class, 'codecontrat', 'id');
    }
    public function beneficiaires()
    {
        return $this->hasMany(Beneficiaire::class, 'codecontrat', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'codecontrat', 'id');
    }

    public function agenceBanque()
    {
        return $this->belongsTo(AgenceByParter::class, 'partenaire', 'codePartner');
    }

    public function agenceData()
    {
        return $this->belongsTo(AgenceByParter::class, 'agence', 'id');
    }

    public function garanties()
    {
        return $this->hasMany(AssureGarantie::class, 'codecontrat', 'id');
    }


    public function documentsLoyemp()
    {
        return $this->hasMany(Document::class, 'codecontrat', 'id')
                    ->where('source', 'ES');
    }

       public function getDocumentsBasedOnProduct()
    {
        return $this->codeproduit === 'loyemp' 
            ? $this->documentsLoyemp 
            : $this->documents;
    }
}

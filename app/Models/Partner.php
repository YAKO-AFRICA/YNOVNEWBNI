<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'tblpartenaires';

    protected $fillable = [
        'code',
        'designation',
        'activitesprincipales',
        'capital',
        'formejuridique',
        'comptecontribuable',
        'nrc',
        'telephone',
        'mobile1',
        'mobile2',
        'adresseemail',
        'siteweb',
        'logo',
        'actif',
        'parent',
        'code_client',
        'code_fournisseur',
        'code_compta',
        'code_compta_fournisseur',
        'bp',
        'ville',
        'departement',
        'pays',
        'user_master',
        'socialnetworks',
        'devise',
        'tauxcom',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'tblfacture';
    protected $primaryKey = 'idFacture';
    public $timestamps = false;

    protected $fillable = [
        'idProposition',
        'codePaiement',
        'prime',
        'etat',
        'dateAjout',
        'typePaiement',
        'referenceSource',
        'idcontrat',
        'saisiele'
    ];


}
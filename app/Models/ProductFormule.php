<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFormule extends Model
{
    use HasFactory;

    protected $table = 'tblproduitformules';

    protected $fillable = [
        'IDTblProduitFormules',
        'CodeProduitFormule',
        'CodeProduit',
        'MonLibelle',
        'DateCreation',
        'DateDebut',
        'DateFin',
        'EstActif',
        'CodePlanCom',
        'Observation',
        'ID_Old',
        'CodeContractant',
        'CodeGroupeProfil',
        'CodeGroupeAssure',
        'Fa',
        'Fg',
        'tx',
        'CodeCanalDistribution',
    ];
}

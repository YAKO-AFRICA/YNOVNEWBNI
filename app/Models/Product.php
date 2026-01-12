<?php

namespace App\Models;

// use App\Models\Product;
use App\Models\Prospect;
use App\Models\ProduitGarantie;
use App\Models\ProspectProduct;
use App\Models\TblTypePrestation;
use App\Models\TblProductPrestation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'tblproduit';

    protected $fillable = [
        'IdProduit',
        'CodeProduit',
        'MonLibelle',
        'DateProduit',
        'CodeBranche',
        'CodeProduitNature',
        'CodeDocument',
        'CodeTxTech',
        'Statut',
        'CodeGroupeAssure',
        'CodeGroupeProfil',
        'AgeMiniAdh',
        'AgeMaxiAdh',
        'TableTarification',
        'TableReglementaire',
        'TableFiscale',
        'TableComptable',
        'CodeContractant',
        'NumSeq',
        'DelaiCarrence',
        'CapitalAssurePMOK',
        'CapitalassureVersExcpOK',
        'CodeBrancheDeux',
        'TypeContrat',
        'Capital',
        'CodeProduitCourt',
        'ID_Old',
        'DureeSouscriptionAnnee',
        'DureeSouscriptionMois',
        'VieEntiere',
        'DureeCotisationAns',
        'DureeCotisationMois',
        'CodeMarque',
    ];

    public function garanties()
    {
        return $this->hasMany(ProduitGarantie::class, 'CodeProduit', 'codeproduit');
    }

    public function typePrestations()
    {
        return $this->hasMany(TblProductPrestation::class, 'product_id', 'CodeProduit');
        
    }

    // public function typePrestations()
    // {
    //     return $this->hasMany(TblTypePrestation::class, 'product_id', 'CodeProduit');
    //     // return $this->belongsToMany(TblTypePrestation::class, 'tbl_product_prestations', 'product_id', 'prestation_id');
    // }
    
}



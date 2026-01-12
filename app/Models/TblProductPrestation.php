<?php

namespace App\Models;

use App\Models\Product;
use App\Models\TblTypePrestation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblProductPrestation extends Model
{
    use HasFactory;

    // protected $table = 'tbl_product_prestations';
    protected $connection = 'mysql2';
    protected $fillable = [
        'product_id',
        'product_type',
        'prestation_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'CodeProduit');
    }

    public function prestation()
    {
        return $this->belongsTo(TblTypePrestation::class, 'prestation_id', 'id');
    }

}

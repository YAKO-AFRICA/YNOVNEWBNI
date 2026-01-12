<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblTypePrestation extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql2';
    protected $table = 'tbl_type_prestations';
    protected $fillable = [
        'libelle',
        'description',
        'impact',
        'etat',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'tbl_product_prestations', 'prestation_id', 'product_id');
    }
}

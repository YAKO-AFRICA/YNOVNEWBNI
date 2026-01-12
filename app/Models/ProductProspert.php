<?php

namespace App\Models;

use App\Models\Product;
use App\Models\AdherentProspert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductProspert extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    // protected $table = 'product_prospert';
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'code',
        'product_uuid',
        'prospert_uuid',
    ];

    public function prospert()
    {
        return $this->belongsTo(AdherentProspert::class, 'prospert_uuid', 'uuid');
    }

     public function itemProduct()
    {
        return $this->belongsTo(Product::class, 'product_uuid','CodeProduit');
    }
}

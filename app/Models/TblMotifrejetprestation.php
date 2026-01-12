<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblMotifrejetprestation extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tbl_motifrejetprestations';

    protected $fillable = [
        'code',
        'keyword',
        'libelle',
        'etat'
    ];

    // public function prestation()
    // {
    //     return $this->belongsTo(TblPrestation::class);
    // }
    
}

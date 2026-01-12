<?php

namespace App\Models;

use App\Models\TblPrestation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblDocPrestation extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tbl_doc_prestations';
    protected $fillable = [
        'idPrestation',
        'filename',
        'libelle',
        'path',
        'type',
    ];
    public function prestation()
    {
        return $this->belongsTo(TblPrestation::class, 'idPrestation', 'id');
    }
}

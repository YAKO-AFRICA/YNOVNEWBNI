<?php

namespace App\Models;

use App\Models\TblVilleReseau;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblOptionrdv extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tbloptionrdv';
    protected $fillable = [
        'id',
        'codelieu',
        'jour',
        'nbmax',
        'codemanager',
        'codejour'
    ];
    // Désactiver les timestamps
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function villeReseau(){
        return $this->belongsTo(TblVilleReseau::class, 'codelieu', 'idVilleBureau');
    }
}

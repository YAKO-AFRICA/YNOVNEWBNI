<?php

namespace App\Models;

use App\Models\Tblrdv;
use App\Models\TblOptionrdv;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblVilleReseau extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tblvillebureau';
    protected $fillable = [
        'idVilleBureau',
        'libelleVilleBureau',
        'localisation'
    ];
    // Désactiver les timestamps
    public $timestamps = false;
    protected $primaryKey = 'idVilleBureau';

    public function rdv(){
        return $this->hasMany(Tblrdv::class, 'idTblBureau', 'idVilleBureau');
    }
    public function optionRdv(){
        return $this->hasMany(TblOptionrdv::class, 'codelieu', 'idVilleBureau');
    }
}

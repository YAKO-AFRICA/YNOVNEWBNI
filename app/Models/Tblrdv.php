<?php

namespace App\Models;

use App\Models\TblVilleReseau;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tblrdv extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tblrdv';
    public $fillable = [
        'idrdv',
        'nomclient',
        'tel',
        'email',
        'daterdv',
        'messageclient',
        'codedmd',
        'dateajou',
        'etat',
        'motifrdv',
        'police',
        'reponse',
        'datetraitement',
        'gestionnaire',
        'envoimail',
        'titre',
        'datenaissance',
        'lieuresidence',
        'idTblBureau',
        'villeEffective',
        'createdAt',
        'reponseGest',
        'estPermit',
        'idCourrier',
        'creeLe',
        'updatedAt',
        'traiterLe',
        'daterdveff',
        'transmisPar',
        'etatSms',
        'orderInsert',
        'oldgestionnaire',
        'rangaff',
    ];
    // Désactiver les timestamps
    public $timestamps = false;
    // 
    protected $primaryKey = 'idrdv';
    public function ville(){
        return $this->belongsTo(TblVilleReseau::class, 'idTblBureau', 'idVilleBureau');
    }
}

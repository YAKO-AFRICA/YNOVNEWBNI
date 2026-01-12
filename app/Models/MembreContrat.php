<?php

namespace App\Models;

use App\Models\Membre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembreContrat extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'membrecontrat';
    protected $fillable = ['id', 'codemembre', 'idcontrat'];

    // Désactiver les timestamps
    public $timestamps = false;
    protected $primaryKey = 'id';


    public function membre()
    {
        return $this->belongsTo(Membre::class,'codemembre', 'idmembre');
    }
}

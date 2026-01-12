<?php

namespace App\Models;

use App\Models\Assurer;
use App\Models\Contrat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SanteAssur extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'EtatSante',
        'diabete',
        'avc',
        'cancer',
        'insuffRenal',
        'hypertension',
        'codeAssur',
        'codeContrat',
        'etat',
    ];

    public function assure()
    {
        return $this->belongsTo(Assurer::class, 'codeAssur', 'id');
    }

    public function contrat()
    {
        return $this->belongsTo(Contrat::class, 'codeContrat', 'id');
    }
}

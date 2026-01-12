<?php

namespace App\Models;

use App\Models\ReseauProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reseau extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'tblreseau';

    public $timestamps = false;

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'codereseau',
        'libelle',
        'coderesponsable',
        'codebranche',
        'nomresponsable',
        'codepartenaire',
    ];

    public function products()
    {
        return $this->hasMany(ReseauProduct::class, 'codereseau');
    }
}

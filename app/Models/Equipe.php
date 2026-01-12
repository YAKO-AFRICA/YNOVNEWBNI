<?php

namespace App\Models;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipe extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblequipe';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'codeequipe',
        'libelleequipe',
        'codezone',
        'coderesponsable',
        'nomresponsable',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'codezone', 'id');
    }

}


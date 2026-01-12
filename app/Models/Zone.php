<?php

namespace App\Models;

use App\Models\Reseau;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zone extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblzone';

    protected $primaryKey = 'id';
    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'codezone',
        'codereseau',
        'libellezone',
        'coderesponsable',
        'nomresponsable',
    ];

    public function reseau()
    {
        return $this->belongsTo(Reseau::class, 'codereseau', 'id');
    }
}


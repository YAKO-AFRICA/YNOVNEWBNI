<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblVille extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tbl_ville';

    protected $fillable = [
        'idville',
        'libelleVillle'
    ];
    // Désactiver les timestamps
    public $timestamps = false;
    protected $primaryKey = 'idville';

    
}
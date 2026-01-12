<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblMotifrejetbyprestat extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tbl_motifrejetbyprestats';

    protected $fillable = [
        'codeprestation',
        'codemotif',
    ];
    public function prestation()
    {
        return $this->belongsTo(TblPrestation::class, 'codeprestation', 'code');
    }
    public function motif()
    {
        return $this->belongsTo(TblMotifrejetprestation::class, 'codemotif', 'code');
    }
}

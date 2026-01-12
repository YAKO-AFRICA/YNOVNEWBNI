<?php

namespace App\Models;

use App\Models\AdherentProspert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class contactProspert extends Model
{
    use HasFactory;

    protected $table = 'contact_prosperts';
    protected $connection = 'mysql3';

    protected $fillable = [
        'uuid',
        'code',
        'etat',
        'prospert_uuid',
        'contactType',
        'contact',
    ];

    public function prospert()
    {
        return $this->belongsTo(AdherentProspert::class, 'prospert_uuid', 'uuid');
    }
}

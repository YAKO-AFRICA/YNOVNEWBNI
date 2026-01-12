<?php

namespace App\Models;

use App\Models\AdherentProspert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentProspert extends Model
{
    use HasFactory;

    protected $table = 'document_prosperts';
    protected $connection = 'mysql3';

    protected $fillable = [
        'uuid',
        'code',
        'prospert_uuid',
        'filepath',
        'fileName',
        'nature',
        'etat',
    ];

    public function prospert()
    {
        return $this->belongsTo(AdherentProspert::class, 'prospert_uuid', 'uuid');
    }
}

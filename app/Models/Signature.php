<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;


    protected $connection = 'mysql2';
    protected $table = 'tbl_signatures';

    protected $fillable = [
        'operation_type',
        'reference_key',
        'key_uuid',
        'email',
        'recto_path',
        'verso_path',
        'signature_path',
        'status',
    ];
}

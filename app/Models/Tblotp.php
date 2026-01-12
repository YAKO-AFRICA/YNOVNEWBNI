<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tblotp extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tblotps';
    protected $fillable = [
        'id',
        'codeOTP',
        'used',
        'operation_type',
        'operation_key',
        'contact_method',
        'contact',
        'otp_attempts',
    ];
}

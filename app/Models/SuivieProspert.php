<?php

namespace App\Models;

use App\Models\User;
use App\Models\Prospect;
use App\Models\AdherentProspert;
use App\Models\ProspectFollowup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuivieProspert extends Model
{
    use HasFactory;

    protected $connection = 'mysql3';

    protected $fillable = [
        'uuid',
        'prospect_uuid',
        'type',
        'user_id',
        'notes',
        'followup_date',
        'next_followup_date',
        'status'
    ];



    protected $casts = [
        'followup_date' => 'datetime',
        'next_followup_date' => 'datetime',
    ];

    public function prospect()
    {
        return $this->belongsTo(AdherentProspert::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'idmembre');
    }

   
}

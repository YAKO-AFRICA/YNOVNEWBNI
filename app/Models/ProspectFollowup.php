<?php

namespace App\Models;

use App\Models\User;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProspectFollowup extends Model
{
    use HasFactory;

    protected $connection = 'mysql3';

    protected $fillable = [
        'uuid',
        'prospect_id',
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
        return $this->belongsTo(Prospect::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

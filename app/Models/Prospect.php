<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\TblVille;
use App\Models\Profession;
use App\Models\ProspectProduct;
use App\Models\ProspectFollowup;
use App\Models\TblSecteurActivite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prospect extends Model
{
    use HasFactory;

    protected $connection = 'mysql3';

    protected $table = 'prospects';

    protected $fillable = [
        'uuid',
        'code',
        'first_name',
        'last_name',
        'mobile',
        'email',
        'adress',
        'montantPrime',
        'dateEffet',
        'profession_uuid',
        'secteurActivity_uuid',
        'modeDePaiment',
        'typeCompagnie',
        'city',
        'lieuEvenement',
        'natureProspect',
        'note',
        'produit_id',
        'etat',
        'status',
        'userAdd_uuid',
        'userDestroy_uuid',
        'destroy_date',
        'update_by',
        'assign_to',
        'assigned_by',
        'assign_date',
        'created_at',
        'updated_at'
    ];

    public function userAdd()
    {
        return $this->belongsTo(User::class, 'userAdd_uuid','id');
    }
    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_by','idmembre');
    }
    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assign_to','idmembre');
    }
    public function updateBy()
    {
        return $this->belongsTo(User::class, 'update_by','idmembre');
    }


    public function followups()
    {
        return $this->hasMany(ProspectFollowup::class)->orderBy('followup_date', 'desc');
    }

    public function profession()
    {
        return $this->belongsTo(TblProfession::class, 'profession_uuid','IdProfession');
    }
    public function secteurActivity()
    {
        return $this->belongsTo(TblSecteurActivite::class, 'secteurActivity_uuid','IdSecteurActiviteSocietes');
    }
    public function ville()
    {
        return $this->belongsTo(TblVille::class, 'city','idville');
    }

    public function products()
    {
        return $this->hasMany(ProspectProduct::class);
    }


}

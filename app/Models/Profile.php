<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    
    protected $table = 'roless';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'membre_id',
        'codereseau',
        'role'
    ];


    // protected $fillable = [
    //     'id',
    //     'uuid',
    //     'idmembre',
    //     'nom',
    //     'prenom',
    //     'telephone',
    //     'email',
    //     'adresse',
    //     'lieuresidence',
    //     'lieunaissance',
    //     'profession',
    //     'nomagence',
    //     'sexe',
    //     'role',
    //     'photo_url',
    //     'codereseau',
    //     'codezone',
    //     'codeequipe',
    //     'codeagent',
    //     'branche',
    //     'partenaire',
    //     'codepartenaire',
    //     'agence',
    //     'lastUpdate',
    //     'etat',
    //     'deleted_at',
    //     'created_at',
    //     'updated_at',
        
    // ];


}
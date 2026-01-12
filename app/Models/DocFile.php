<?php

namespace App\Models;

use App\Models\DocFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'folderParent_id',
        'isPrivate',
        'user_id',
        'etat',
        'deleted_at',
        'deleted_by',
    ];

    public function parent()
    {
        return $this->belongsTo(DocFile::class, 'folderParent_id');
    }

    public function children()
    {
        return $this->hasMany(DocFile::class, 'folderParent_id');
    }

    // Chargez toujours les enfants avec le dossier
    protected $with = ['children'];
}

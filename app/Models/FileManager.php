<?php

namespace App\Models;

use App\Models\DocFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uuid',
        'path',
        'mime_type',
        'size',
        'extension',
        'folder_id',
        'description',
        'etat',
        'user_id',
        'deleted_at',
        'deleted_by',
    ];

    public function folder()
    {
        return $this->belongsTo(DocFile::class, 'folder_id');
    }
}


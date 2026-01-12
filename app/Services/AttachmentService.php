<?php

namespace App\Services;

use App\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class AttachmentService
{
    public function upload(UploadedFile $file, Model $model, int $userId): Attachment
    {
        $path = $file->store('attachments', 'public');

        return $model->attachments()->create([
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'user_id' => $userId,
        ]);
    }

    public function delete(Attachment $attachment): bool
    {
        Storage::disk('public')->delete($attachment->path);
        return $attachment->delete();
    }
}
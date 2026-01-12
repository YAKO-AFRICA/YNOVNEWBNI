<?php

namespace App\Http\Controllers\Admin;

use App\Models\DocFile;
use App\Models\FileManager;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FileManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function fileStats()
    {
        $files = FileManager::all();
        
        $stats = [
            'images' => [
                'count' => 0,
                'size' => 0,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'],
                'icon' => 'bx bx-image',
                'color' => 'primary'
            ],
            'documents' => [
                'count' => 0,
                'size' => 0,
                'extensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv'],
                'icon' => 'bx bxs-file-doc',
                'color' => 'success'
            ],
            'media' => [
                'count' => 0,
                'size' => 0,
                'extensions' => ['mp4', 'mov', 'avi', 'mkv', 'mp3', 'wav', 'flac'],
                'icon' => 'bx bx-video',
                'color' => 'danger'
            ],
            'archives' => [
                'count' => 0,
                'size' => 0,
                'extensions' => ['zip', 'rar', '7z', 'tar', 'gz'],
                'icon' => 'bx bxs-file-archive',
                'color' => 'warning'
            ],
            'other' => [
                'count' => 0,
                'size' => 0,
                'icon' => 'bx bxs-file',
                'color' => 'info'
            ]
        ];
        
        foreach ($files as $file) {
            $extension = strtolower($file->extension);
            $found = false;
            
            foreach ($stats as $type => &$data) {
                if ($type !== 'other' && in_array($extension, $data['extensions'])) {
                    $data['count']++;
                    $data['size'] += $file->size;
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                $stats['other']['count']++;
                $stats['other']['size'] += $file->size;
            }
        }
        
        // Conversion des tailles en Go/Mo/Ko
        foreach ($stats as &$group) {
            $group['size_readable'] = $this->formatSize($group['size']);
        }
        
        return $stats;
    }

    private function formatSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    public function index()
    {
        $folders = DocFile::with('children')->whereNull('folderParent_id')->get();
        $allFolders = DocFile::all();
        $fileByFolder = FileManager::all();
        $stats = $this->fileStats();
        
        return view("fileManager.index", compact('folders', 'fileByFolder', 'stats', 'allFolders'));
    }

    public function getFilesByFolder($folderId)
    {
        $query = FileManager::query();
        
        if ($folderId !== 'all') {
            $query->where('folder_id', $folderId);
        }
        
        $files = $query->with('folder')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($file) {
                return [
                    'id' => $file->id,
                    'name' => $file->name,
                    'extension' => $file->extension,
                    'folder_name' => $file->folder ? $file->folder->name : null,
                    'created_at' => $file->created_at,
                    'size' => $file->size,
                    'uuid' => $file->uuid,
                    'path' => $file->path
                ];
            });
        
        return response()->json(['files' => $files]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function storeFolder(Request $request)
    {
        DB::beginTransaction();
        try {
            DocFile::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'description' => $request->description,
                'isPrivate' => $request->isPrivate ?? 'false',
                'folderParent_id' => $request->folderParent_id,
                'user_id' => auth()->id(),
                'etat' => 'actif',
            ]);

            DB::commit();
            
            return response()->json([
                'type' => 'success',
                'urlback' => "back",
                'message' => "Dossier créé avec succès!",
                'code' => 200,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! " . $th->getMessage(),
                'code' => 500,
            ]);
        }
    }

    public function storeFile(Request $request)
    {
        DB::beginTransaction();
        try {
          

            
            $disk = 'external';
            
            foreach ($request->file('files') as $file) {
                
                $uuid = Str::uuid()->toString();
                
                $customPath = date('Y/m');
                
                $path = $file->store($customPath, $disk);
                
                // Créer l'enregistrement
                FileManager::create([
                    'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                    'uuid' => $uuid,
                    'extension' => $file->getClientOriginalExtension(),
                    'folder_id' => $request->folder_id,
                    'description' => $request->description,
                    'user_id' => auth()->id(),
                ]);
            }
            DB::commit();
            
            return response()->json([
                'type' => 'success',
                'urlback' => "back",
                'message' => "Enregistré avec succès!",
                'code' => 200,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

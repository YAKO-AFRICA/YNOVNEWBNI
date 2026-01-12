<?php

function Refgenerate($table, $prefix, $key)
{
    // Récupérer le dernier enregistrement de la table
    $latest = $table::orderBy('id', 'desc')->first();
    
    // Si aucun enregistrement n'existe, retourner le format initial
    if (!$latest || !isset($latest->$key)) {
        return $prefix . '-00001';
    }
    
    // Extraire la partie numérique du code
    $number = preg_replace("/[^0-9]/", '', $latest->$key);
    
    // Si aucune partie numérique n'est trouvée, commencer à 1
    if (empty($number)) {
        $number = 0;
    }
    
    // Générer le prochain code avec un format à 5 chiffres
    return $prefix . '-' . sprintf('%05d', $number + 1);
}
function RefgenerateCodeMotifRejet($table, $prefix, $key)
{
    // Récupérer le dernier enregistrement de la table
    $latest = $table::orderBy('id', 'desc')->first();
    
    // Si aucun enregistrement n'existe, retourner le format initial
    if (!$latest || !isset($latest->$key)) {
        return $prefix . '-001';
    }
    
    // Extraire la partie numérique du code
    $number = preg_replace("/[^0-9]/", '', $latest->$key);
    
    // Si aucune partie numérique n'est trouvée, commencer à 1
    if (empty($number)) {
        $number = 0;
    }
    
    // Générer le prochain code avec un format à 5 chiffres
    return $prefix . '-' . sprintf('%05d', $number + 1);
}

function RefgenerateCode($table, $init, $key)
{
    $latest = $table::orderBy('idrdv', 'desc')->first();
    if (!$latest) {
        $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
        return $code;
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);
    $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
    return $code;
}

function RefgenerateCodePrest($table, $init, $key)
{
    $latest = $table::orderBy('id', 'desc')->first();
    if (!$latest) {
        $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
        return $code;
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);
    $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
    return $code;
} 

// function RefgenerateOTP($table, $key)
// {
//     $latest = $table::orderBy('id', 'desc')->first();
//     if (!$latest) {
//         $code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
//         return $code;
//     }

//     $string = preg_replace("/[^0-9\.]/", '', $latest->$key);
//     $code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

    
//     return $code;
// }
function RefgenerateOTP($table, $key)
{
    $latest = $table::orderBy('id', 'desc')->first();
    if (!$latest) {
        $code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
        return $code;
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);
    $code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

    
    return $code;
}


if (!function_exists('getFileIcon')) {
    function getFileIcon($mimeType) {
        $icons = [
            'image/' => 'image',
            'application/pdf' => 'pdf',
            'application/msword' => 'word',
            'application/vnd.ms-excel' => 'excel',
            'application/vnd.ms-powerpoint' => 'powerpoint',
            'text/plain' => 'alt',
            'application/zip' => 'archive',
            'application/x-rar-compressed' => 'archive',
        ];
        
        foreach ($icons as $key => $icon) {
            if (str_starts_with($mimeType, $key)) {
                return $icon;
            }
        }
        
        return 'file';
    }
}

if (!function_exists('getFileColor')) {
    function getFileColor($mimeType) {
        $colors = [
            'image/' => 'info',
            'application/pdf' => 'danger',
            'application/msword' => 'primary',
            'application/vnd.ms-excel' => 'success',
            'application/vnd.ms-powerpoint' => 'warning',
            'text/plain' => 'secondary',
            'application/zip' => 'dark',
        ];
        
        foreach ($colors as $key => $color) {
            if (str_starts_with($mimeType, $key)) {
                return $color;
            }
        }
        
        return 'dark';
    }
}

if (!function_exists('formatFileSize')) {
    function formatFileSize($bytes) {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return '1 byte';
        } else {
            return '0 bytes';
        }
    }
}


?>
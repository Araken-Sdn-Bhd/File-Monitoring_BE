<?php

if (!function_exists('upload_file')) {
    function upload_file($file, $folder_name)
    {
        try {
            $path = $file->store('assets/' . $folder_name, 'public');
            return response()->json(['code' => 200, 'path' => '/storage/' . $path]);
        } catch (Exception $e) {
            return response()->json(['code' => 500, 'path' => $e->getMessage()]);
        }
    }
}
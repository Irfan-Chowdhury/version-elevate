<?php
namespace IrfanChowdhury\VersionElevate\Traits;

use Illuminate\Support\Facades\File;

trait JSONFileTrait{

    public function wrtieDataInJSON($array_data, $file_path)
    {
        // $path = base_path($file_path);
        $path = __DIR__ . '/../../' . $file_path;
        $json = json_encode($array_data);
        file_put_contents($path, $json);
    }

    public function readJSONData($file_path)
    {
        $path = __DIR__ . '/../../' . $file_path;
        $json_data = null;
        if (File::exists($path)) {
            $json_file = File::get($path);
            $json_data = json_decode($json_file);
        }
        return $json_data;
    }

}

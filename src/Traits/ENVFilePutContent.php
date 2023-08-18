<?php
namespace IrfanChowdhury\VersionElevate\Traits;

trait ENVFilePutContent{

    public function dataWriteInENVFile($key,$value)
    {
        // $path = base_path('.env');

        $path = app()->environmentFilePath();
        $searchArray = array($key.'='.env($key));
        $replaceArray= array($key.'='.$value);

        file_put_contents($path, str_replace($searchArray, $replaceArray, file_get_contents($path)));
    }

}

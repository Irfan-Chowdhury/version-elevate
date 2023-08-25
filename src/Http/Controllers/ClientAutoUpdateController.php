<?php

namespace IrfanChowdhury\VersionElevate\Http\Controllers;

use IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait;
use IrfanChowdhury\VersionElevate\Traits\ENVFilePutContent;
use IrfanChowdhury\VersionElevate\Traits\JSONFileTrait;
use Exception;
use ZipArchive;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ClientAutoUpdateController extends Controller
{
    use ENVFilePutContent, JSONFileTrait, AutoUpdateTrait;

    public function newVersionReleasePage()
    {
        $autoUpdateData = $this->general();
        $getVersionUpgradeDetails = $this->getVersionUpgradeDetails();
        $newVersion = $autoUpdateData['generalData']->general->demo_version ?? 0;
        $alertVersionUpgradeEnable = $autoUpdateData['alertVersionUpgradeEnable'];
        
        return view('version-elevate::version_upgrade.index', compact('getVersionUpgradeDetails','alertVersionUpgradeEnable','newVersion'));
    }

    /*
    |--------------------------------------------------------------------------
    | Action on Client Server
    |--------------------------------------------------------------------------
    |
    | matchFilesFromServerBeforeExecute() -> from server it will be match with fetch-data-upgrade.json.
    | And check all before execute files
    | fileTransferProcess() -> it will send files from "your_domain.com" server to client server
    |
    */

    public function versionUpgradeProcees()
    {
        $general = $this->general();
        $trackGeneralArr = $general['generalData']->general;
        $versionUpgradeBaseURL = $general['generalData']->general->version_upgrade_base_url;

        $getFilesAndLogsDetail = $this->getVersionUpgradeDetails();
        try {
            $this->matchFilesFromServerBeforeExecute($getFilesAndLogsDetail, $trackGeneralArr, $versionUpgradeBaseURL);

            // Start Execute
            if ($getFilesAndLogsDetail && $trackGeneralArr) {
                $this->fileTransferProcess($getFilesAndLogsDetail, $versionUpgradeBaseURL);

                $this->dataWriteInENVFile('VERSION',$trackGeneralArr->demo_version);

                if ($trackGeneralArr->latest_version_db_migrate_enable==true) {
                    Artisan::call('migrate');
                }
                Artisan::call('optimize:clear');

                return redirect()->back()->with([
                    'message' => 'Version Upgraded Successfully !!!',
                    'type' => 'success',
                ]);
            }
            else{
                throw new Exception("Something wrong. Please contact with support team.");
            }
        }
        catch(Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    protected function matchFilesFromServerBeforeExecute($getFilesAndLogsDetail, $trackGeneralArr, $versionUpgradeBaseURL)
    {
        if ($getFilesAndLogsDetail && $trackGeneralArr) {
            foreach ($getFilesAndLogsDetail->files as $value) {
                $remote_file_url  = $versionUpgradeBaseURL.$value->file_name;
                $array = @get_headers($remote_file_url);
                $string = $array[0];
                if(!strpos($string, "200")) {
                    throw new Exception("Something wrong. Please contact with support team.");
                }
            }
        }else{
            throw new Exception("Something wrong. Please contact with support team.");
        }
    }

    protected function fileTransferProcess($getFilesAndLogsDetail, $versionUpgradeBaseURL)
    {
        foreach ($getFilesAndLogsDetail->files as $value) {
            $remote_file_url  = $versionUpgradeBaseURL.$value->file_name;
            $remote_file_name = pathinfo($remote_file_url)['basename'];
            $local_file = base_path('/'.$remote_file_name);
            $copy = copy($remote_file_url, $local_file);
            if ($copy) {
                // ****** Unzip ********
                $zip = new ZipArchive;
                $file = base_path($remote_file_name);
                $res = $zip->open($file);
                if ($res === TRUE) {
                    $zip->extractTo(base_path('/'));
                    $zip->close();

                    // ****** Delete Zip File ******
                    File::delete($remote_file_name);
                }
            }
        }
    }
}

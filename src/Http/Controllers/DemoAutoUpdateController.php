<?php

namespace IrfanChowdhury\VersionElevate\Http\Controllers;

use IrfanChowdhury\VersionElevate\Traits\ENVFilePutContent;
use IrfanChowdhury\VersionElevate\Traits\JSONFileTrait;
use Illuminate\Support\Facades\File;

class DemoAutoUpdateController extends Controller
{
    /*************************************************
    *
    *   Developer Controll API || Demo
    *
    **************************************************/

    use ENVFilePutContent, JSONFileTrait;

    private $product_mode;
    private $demo_version;
    private $demo_bug_no;
    private $minimum_required_version;
    private $latest_version_upgrade_enable;
    private $latest_version_db_migrate_enable;
    private $bug_update_enable;
    private $bug_db_migrate_enable;
    private $version_upgrade_base_url;
    private $bug_update_base_url;

    public function __construct()
    {
        $general = $this->readJSONData('track/general.json');
        $control = $this->readJSONData('track/control.json');

        $this->product_mode = env('PRODUCT_MODE');
        $this->demo_version = env('VERSION');
        $this->demo_bug_no  = intval(env('BUG_NO'));
        $this->minimum_required_version = $general->minimum_required_version;

        // Set During New Release Announce
        $this->latest_version_upgrade_enable   = $control->version_upgrade->latest_version_upgrade_enable;
        $this->latest_version_db_migrate_enable= $control->version_upgrade->latest_version_db_migrate_enable;
        $this->version_upgrade_base_url        = $control->version_upgrade->version_upgrade_base_url; // Fixed | Connect with server

        // Set During Bug Update
        // $this->bug_update_enable     = $control->bug_update->bug_update_enable;
        // $this->bug_db_migrate_enable = $control->bug_update->bug_db_migrate_enable;
        // $this->bug_update_base_url   = $control->bug_update->bug_update_base_url;  // Fixed | Connect with server
    }



    public function fetchDataGeneral()
    {
        $data = [
            'general'=>
            [
                'product_mode'              => $this->product_mode,
                'demo_version'              => $this->demo_version,
                'minimum_required_version'  => $this->minimum_required_version,
                'demo_bug_no'               => $this->demo_bug_no,
                'latest_version_upgrade_enable'=> $this->latest_version_upgrade_enable,
                'latest_version_db_migrate_enable' => $this->latest_version_db_migrate_enable,
                'version_upgrade_base_url'  => $this->version_upgrade_base_url,
            ],
        ];
        return response()->json($data,201);
    }

    public function fetchDataForAutoUpgrade()
    {
        $path = base_path('track/fetch-data-upgrade.json');
        $data = null;
        if (File::exists($path)) {
            $json_file = File::get($path);
            $data = json_decode($json_file);
        }
        return response()->json($data,201);
    }
}

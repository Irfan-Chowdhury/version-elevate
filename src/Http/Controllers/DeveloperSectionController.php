<?php

namespace IrfanChowdhury\VersionElevate\Http\Controllers;

use IrfanChowdhury\VersionElevate\Http\Controllers\Controller;

use Illuminate\Http\Request;
use IrfanChowdhury\VersionElevate\Http\Requests\DeveloperSectionRequest;
use IrfanChowdhury\VersionElevate\Traits\ENVFilePutContent;
use IrfanChowdhury\VersionElevate\Traits\JSONFileTrait;

class DeveloperSectionController
{
    use ENVFilePutContent, JSONFileTrait;

    public function index()
    {
        if(config('version_elevate.product_mode')!=='DEVELOPER'){
            abort(404);
        }
        $general = $this->readJSONData('track/general.json');
        $control = $this->readJSONData('track/control.json');
        // $bugSettings = $this->readJSONData('track/fetch-data-bug.json');
        $versionUpgradeSettings = $this->readJSONData('track/fetch-data-upgrade.json');

        return view('version-elevate::developer_section.index',compact('general','control','versionUpgradeSettings'));
    }


    // public function submit(DeveloperSectionRequest $request)
    public function submit(Request $request)
    {
        $general =[
            "product_mode"=> config('version_elevate.product_mode'),
            "version"     => $request->version,
            "bug_no"      => $request->bug_no,
            "minimum_required_version" => $request->minimum_required_version,
        ];

        // $this->dataWriteInENVFile('VERSION',$request->version);
        // $this->dataWriteInENVFile('BUG_NO',$request->bug_no);

        $control =[
            'version_upgrade'=>[
                'latest_version_upgrade_enable'    => $request->latest_version_upgrade_enable ? true : false,
                'latest_version_db_migrate_enable' => $request->latest_version_db_migrate_enable ? true : false,
                'version_upgrade_base_url'         => $request->version_upgrade_base_url,
            ],
        ];

        // Write Array in JSON File
        $this->wrtieDataInJSON($general, 'track/general.json');
        $this->wrtieDataInJSON($control ,'track/control.json');



        // session()->put('message', 'Data Submited Successfully');
        // session()->put('type', 'success');

        return redirect()->back()->with([
            'message' => 'Data Submited Successfully',
            'type' => 'success',
        ]);
    }
}

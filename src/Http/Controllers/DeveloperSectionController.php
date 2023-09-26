<?php

namespace IrfanChowdhury\VersionElevate\Http\Controllers;

use Illuminate\Http\Request;
use IrfanChowdhury\VersionElevate\Http\Requests\DeveloperSectionRequest;
use IrfanChowdhury\VersionElevate\Http\Requests\VersionUpgradeRequest;
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
        $versionUpgradeSettings = $this->readJSONData('track/fetch-data-upgrade.json');

        return view('version-elevate::developer_section.index',compact('general','control','versionUpgradeSettings'));
    }


    public function submit(DeveloperSectionRequest $request)
    {
        $general =[
            "product_mode"=> config('version_elevate.product_mode'),
            "version"     => $request->version,
            "minimum_required_version" => $request->minimum_required_version,
        ];

        $this->dataWriteInENVFile('VERSION',$request->version);

        $control =[
            'version_upgrade'=>[
                'latest_version_upgrade_enable'    => $request->latest_version_upgrade_enable ? true : false,
                'latest_version_db_migrate_enable' => $request->latest_version_db_migrate_enable ? true : false,
                'version_upgrade_base_url'         => $request->version_upgrade_base_url,
            ],
        ];

        $this->wrtieDataInJSON($general, 'track/general.json');
        $this->wrtieDataInJSON($control ,'track/control.json');

        return redirect()->back()->with([
            'message' => 'Data Submited Successfully',
            'type' => 'success',
        ]);
    }

    public function versionUpgradeSetting(VersionUpgradeRequest $request)
    {
        foreach($request->file_name as $item) {
            if($item===null) {
                return redirect()->back()->withErrors('Files can not be null.');
            }
        }

        foreach($request->text as $item) {
            if($item===null) {
                return redirect()->back()->withErrors('Logs can not be null.');
            }
        }

        $data = $this->filesAndLogManage($request);

        $this->wrtieDataInJSON($data, 'track/fetch-data-upgrade.json');
        return redirect()->back()->with([
            'message' => 'Data Submited Successfully',
            'type' => 'success',
        ]);
    }

    private function filesAndLogManage($request)
    {
        $data = [];
        if ($request->file_name) {
            foreach($request->file_name as $item) {
                $data['files'][]= [
                    'file_name' => $item
                ];
            }
        }

        if ($request->text) {
            foreach($request->text as $item) {
                $data['logs'][]= [
                    'text' => $item
                ];
            }
        }

        if ($request->short_note) {
            $data['short_note'] = $request->short_note;
        }

        return $data;
    }

}

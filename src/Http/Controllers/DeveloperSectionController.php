<?php

namespace IrfanChowdhury\VersionElevate\Http\Controllers;

use IrfanChowdhury\VersionElevate\Http\Controllers\Controller;

use Illuminate\Http\Request;
use IrfanChowdhury\VersionElevate\Traits\ENVFilePutContent;
use IrfanChowdhury\VersionElevate\Traits\JSONFileTrait;

class DeveloperSectionController
{
    use ENVFilePutContent, JSONFileTrait;

    public function index()
    {
        if(config('auto_update.product_mode')!=='DEVELOPER'){
            abort(404);
        }
        $general = $this->readJSONData('track/general.json');
        $control = $this->readJSONData('track/control.json');
        $bugSettings = $this->readJSONData('track/fetch-data-bug.json');
        $versionUpgradeSettings = $this->readJSONData('track/fetch-data-upgrade.json');

        // return view('developer_section.index',compact('general','control','bugSettings','versionUpgradeSettings'));
    }

}

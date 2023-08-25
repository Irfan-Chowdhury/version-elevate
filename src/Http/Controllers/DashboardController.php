<?php

namespace IrfanChowdhury\VersionElevate\Http\Controllers;

use IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;

class DashboardController extends Controller
{
    use AutoUpdateTrait;

    public function index()
    {
        $autoUpdateData = $this->general();
        $alertBugEnable =  $autoUpdateData['alertBugEnable'];
        $alertVersionUpgradeEnable = $autoUpdateData['alertVersionUpgradeEnable'];
        return view('version-elevate::dashboard', compact('alertBugEnable','alertVersionUpgradeEnable'));
    }

    // protected function getDemoGeneralDataByCURL() : object
    // {
    //     $demoURL = config('version_elevate.domain_url');
    //     $curl = curl_init();
    //     curl_setopt_array($curl, [
    //         CURLOPT_RETURNTRANSFER => 1,
    //         CURLOPT_URL => $demoURL.'/api/fetch-data-general',
    //     ]);
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     return json_decode($response, false);
    // }
}

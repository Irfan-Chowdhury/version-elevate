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
        $alertVersionUpgradeEnable = $autoUpdateData['alertVersionUpgradeEnable'];
        return view('version-elevate::dashboard', compact('alertVersionUpgradeEnable'));
    }
}

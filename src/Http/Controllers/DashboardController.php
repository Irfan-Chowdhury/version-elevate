<?php
declare(strict_types=1);

namespace IrfanChowdhury\VersionElevate\Http\Controllers;

use IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait;

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

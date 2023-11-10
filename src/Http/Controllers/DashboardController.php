<?php
declare(strict_types=1);

namespace IrfanChowdhury\VersionElevate\Http\Controllers;

use IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait;

class DashboardController extends Controller
{
    use AutoUpdateTrait;

    public function index()
    {
        if(!env('PRODUCT_MODE') && !env('VERSION') && !env('TARGET_URL')) {
            session()->flash('message', 'PRODUCT_MODE or VERSION or TARGET_URL empty in .env');
            session()->flash('type', 'danger');
        }
        $autoUpdateData = $this->general();
        $alertVersionUpgradeEnable = $autoUpdateData['alertVersionUpgradeEnable'];

        return view('version-elevate::dashboard', compact('alertVersionUpgradeEnable'));
    }
}


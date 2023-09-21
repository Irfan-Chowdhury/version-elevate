<?php

declare(strict_types=1);

namespace IrfanChowdhury\VersionElevate\Traits;

trait AutoUpdateTrait
{
    protected function isServerConnectionOk($targetURL): bool
    {
        $ch = curl_init($targetURL.'/api/fetch-data-general');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set the timeout to 10 seconds
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        $result = json_decode($response);

        return isset($result) && ! empty($result) ? true : false;
    }

    protected function getDemoGeneralDataByCURL($targetURL): ?object
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $targetURL.'/api/fetch-data-general',
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, false);
    }

    /*
    |============================================================
    | # For Version Upgrade - you should follow these point in DEMO :
    |       1. clientVersionNumber >= minimumRequiredVersion
    |       2. latestVersionUpgradeEnable === true
    |       3. productMode==='DEMO'
    |       4. demoVersionNumber > clientVersionNumber
    |===========================================================
    */

    public function general()
    {
        $returnData = [];
        $alertVersionUpgradeEnable = false;
        $targetURL = config('version_elevate.target_url');

        $isServerConnectionOk = $this->isServerConnectionOk($targetURL);

        if (! $isServerConnectionOk) {
            $returnData['alertVersionUpgradeEnable'] = $alertVersionUpgradeEnable;

            return $returnData;
        }

        $data = $this->getDemoGeneralDataByCURL($targetURL);
        $productMode = $data->general->product_mode;
        $minimumRequiredVersion = $data->general->minimum_required_version;
        $clientVersionNumber = config('version_elevate.version');
        $demoVersionNumber = $data->general->demo_version;
        $latestVersionUpgradeEnable = $data->general->latest_version_upgrade_enable;

        $alertVersionUpgradeEnable = $this->isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber);

        $returnData['generalData'] = $data;
        $returnData['alertVersionUpgradeEnable'] = $alertVersionUpgradeEnable;

        return $returnData;
    }

    protected function isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber)
    {
        $isClientExceedMinimumRequiredVersion = $this->isClientExceedMinimumRequiredVersion($minimumRequiredVersion, $clientVersionNumber);
        $isTargetedVersionGreater = self::compareVersionNumber($clientVersionNumber, $demoVersionNumber);

        if ($latestVersionUpgradeEnable && $productMode === 'DEMO' && $isClientExceedMinimumRequiredVersion && $isTargetedVersionGreater) {
            return true;
        }

        return false;
    }

    protected function isClientExceedMinimumRequiredVersion($minimumRequiredVersion, $clientVersionNumber): bool
    {
        if ($minimumRequiredVersion === $clientVersionNumber) {
            return true;
        } else {
            return self::compareVersionNumber($minimumRequiredVersion, $clientVersionNumber);
        }
    }

    protected static function compareVersionNumber($clientVersionNumber, $demoVersionNumber): bool
    {
        $clientVersionArray = explode('.', $clientVersionNumber);
        $demoVersionArray = explode('.', $demoVersionNumber);
        $isGreater = false;
        for ($i = 0; $i < count($demoVersionArray); $i++) {
            if ($demoVersionArray[$i] > $clientVersionArray[$i]) {
                $isGreater = true;
                break;
            }
        }

        return $isGreater;
    }

    public function getVersionUpgradeDetails()
    {
        $demoURL = config('version_elevate.target_url');

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $demoURL.'/api/fetch-data-upgrade',
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, false);

        return $data;
    }

    private function stringToNumberConvert($dataString)
    {
        $myArray = explode('.', $dataString);
        $versionString = '';
        foreach ($myArray as $element) {
            $versionString .= $element;
        }
        $versionConvertNumber = intval($versionString);

        return $versionConvertNumber;
    }
}

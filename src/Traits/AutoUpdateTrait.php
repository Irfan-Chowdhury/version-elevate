<?php
namespace IrfanChowdhury\VersionElevate\Traits;

trait AutoUpdateTrait{


    protected function isServerConnectionOk()
    {
        $ch = curl_init(config('version_elevate.app_url').'/api/fetch-data-general');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set the timeout to 10 seconds
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        $result = json_decode($response);

        return isset($result) && !empty($result) ? 'true' : 'false' ;
    }

    protected function getDemoGeneralDataByCURL()
    {
        $domainURL = config('version_elevate.app_url');
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $domainURL.'/api/fetch-data-general',
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
    |
    | # For Bug Update - you should follow these point in DEMO :
    |       1. clientVersionNumber >= minimumRequiredVersion
    |       2. demoVersionNumber === clientVersionNumber
    |       3. demoBugNo > clientBugNo
    |       4. bugUpdateEnable === true
    |       5. productMode === 'DEMO'
    |===========================================================
    */

    public function general()
    {
        $returnData = [];
        $alertVersionUpgradeEnable = false;

        $isServerConnectionOk = $this->isServerConnectionOk();
        if (!$isServerConnectionOk) {
            $returnData['alertVersionUpgradeEnable'] = $alertVersionUpgradeEnable;
            return $returnData;
        };

        $data = $this->getDemoGeneralDataByCURL();
        $productMode = $data->general->product_mode;
        $clientVersionNumber = $this->stringToNumberConvert(config('version_elevate.version'));
        $demoVersionString      = $data->general->demo_version;
        $demoVersionNumber      = $this->stringToNumberConvert($demoVersionString);
        $minimumRequiredVersion = $this->stringToNumberConvert($data->general->minimum_required_version);
        $latestVersionUpgradeEnable   = $data->general->latest_version_upgrade_enable;

        if ($clientVersionNumber >= $minimumRequiredVersion && $latestVersionUpgradeEnable===true && $productMode==='DEMO' && $demoVersionNumber > $clientVersionNumber) {
            $alertVersionUpgradeEnable = true;
        }

        $returnData['generalData'] = $data;
        $returnData['alertVersionUpgradeEnable'] = $alertVersionUpgradeEnable;
        return $returnData;
    }

    public function getVersionUpgradeDetails()
    {
        $demoURL = config('version_elevate.app_url');

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

    // public function getBugUpdateDetails()
    // {
    //     $demoURL = config('version_elevate.app_url');

    //     $curl = curl_init();
    //     curl_setopt_array($curl, [
    //         CURLOPT_RETURNTRANSFER => 1,
    //         CURLOPT_URL => $demoURL.'/api/fetch-data-bugs',
    //     ]);
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     $data = json_decode($response, false);

    //     return $data;
    // }

    private function stringToNumberConvert($dataString) {
        $myArray = explode(".", $dataString);
        $versionString = "";
        foreach($myArray as $element) {
          $versionString .= $element;
        }
        $versionConvertNumber = intval($versionString);
        return $versionConvertNumber;
    }
}



// echo $minimumRequiredVersion.'</br>';
// echo $demoVersionNumber.'</br>';
// echo $clientVersionNumber.'</br>';
// echo $demoBugNo.'</br>';
// echo $clientBugNo.'</br>';
// echo $bugUpdateEnable.'</br>';
// echo $productMode.'</br>';
// return;
// echo $clientVersionNumber.'</br>';
// echo $minimumRequiredVersion.'</br>';
// echo $latestVersionUpgradeEnable.'</br>';
// echo $productMode.'</br>';
// echo $demoVersionNumber.'</br>';

// $clientVersionNumber = 120; // have to change when testing on bug 119,120
// $demoBugNo           = 1021;

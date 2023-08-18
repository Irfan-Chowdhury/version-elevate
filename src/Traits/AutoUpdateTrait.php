<?php
namespace IrfanChowdhury\VersionElevate\Traits;

trait AutoUpdateTrait{

    protected function isServerConnectionOk()
    {
        $ch = curl_init(config('auto_update.demo_url').'/fetch-data-general');
        // $ch = curl_init("https://jsonplaceholder.typicode.com/todos");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set the timeout to 10 seconds
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        $result = json_decode($response);

        return isset($result) && !empty($result) ? true : false ;
    }

    protected function getDemoGeneralDataByCURL()
    {
        $demoURL = config('auto_update.demo_url');
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $demoURL.'/fetch-data-general',
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
        $alertBugEnable = false;

        $isServerConnectionOk = $this->isServerConnectionOk();
        if (!$isServerConnectionOk) {
            $returnData['alertVersionUpgradeEnable'] = $alertVersionUpgradeEnable;
            $returnData['alertBugEnable'] = $alertBugEnable;
            return $returnData;
        };

        $data = $this->getDemoGeneralDataByCURL();
        $productMode = $data->general->product_mode;
        $clientVersionNumber = $this->stringToNumberConvert(config('auto_update.version'));
        $clientBugNo = intval(config('auto_update.bug_no'));
        $demoVersionString      = $data->general->demo_version;
        $demoVersionNumber      = $this->stringToNumberConvert($demoVersionString);
        $demoBugNo              = $data->general->demo_bug_no;
        $minimumRequiredVersion = $this->stringToNumberConvert($data->general->minimum_required_version);
        $latestVersionUpgradeEnable   = $data->general->latest_version_upgrade_enable;
        $bugUpdateEnable        = $data->general->bug_update_enable;

        if ($clientVersionNumber >= $minimumRequiredVersion && $latestVersionUpgradeEnable===true && $productMode==='DEMO' && $demoVersionNumber > $clientVersionNumber) {
            $alertVersionUpgradeEnable = true;
        }

        if ($clientVersionNumber >= $minimumRequiredVersion && $demoVersionNumber === $clientVersionNumber && $demoBugNo > $clientBugNo && $bugUpdateEnable ===true && $productMode==='DEMO') {
            $alertBugEnable = true;
        }

        $returnData['generalData'] = $data;
        $returnData['alertVersionUpgradeEnable'] = $alertVersionUpgradeEnable;
        $returnData['alertBugEnable'] = $alertBugEnable;
        return $returnData;
    }

    public function getVersionUpgradeDetails()
    {
        $demoURL = config('auto_update.demo_url');

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $demoURL.'/fetch-data-upgrade',
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, false);

        return $data;
    }

    public function getBugUpdateDetails()
    {
        $demoURL = config('auto_update.demo_url');

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $demoURL.'/fetch-data-bugs',
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, false);

        return $data;
    }

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

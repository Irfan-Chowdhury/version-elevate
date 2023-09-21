<?php

// =================== isAlertVersionUpgradeEnable =====================

test('return false if latestVersionUpgradeEnable is false', function () {
    $latestVersionUpgradeEnable = false;
    $productMode = 'DEMO';
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.2';
    $demoVersionNumber = '1.2.3';
    $alertVersionUpgradeEnable = $this->isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber);

    expect($alertVersionUpgradeEnable)->toBeFalsy();
});

test('return false if productMode is other type except DEMO', function () {
    $latestVersionUpgradeEnable = true;
    $productMode = 'DEVELOPER';
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.2';
    $demoVersionNumber = '1.2.3';
    $alertVersionUpgradeEnable = $this->isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber);

    expect($alertVersionUpgradeEnable)->toBeFalsy();
});

test('return false if clientVersionNumber < minimumRequiredVersion', function () {
    $latestVersionUpgradeEnable = true;
    $productMode = 'DEMO';
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.0';
    $demoVersionNumber = '1.2.3';
    $alertVersionUpgradeEnable = $this->isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber);

    expect($alertVersionUpgradeEnable)->toBeFalsy();
});

test('return false if demoVersionNumber < minimumRequiredVersion', function () {
    $latestVersionUpgradeEnable = true;
    $productMode = 'DEMO';
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.2';
    $demoVersionNumber = '1.2.0';
    $alertVersionUpgradeEnable = $this->isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber);

    expect($alertVersionUpgradeEnable)->toBeFalsy();
});

test('return false if clientVersionNumber === demoVersionNumber', function () {
    $latestVersionUpgradeEnable = true;
    $productMode = 'DEMO';
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.2';
    $demoVersionNumber = '1.2.2';
    $alertVersionUpgradeEnable = $this->isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber);

    expect($alertVersionUpgradeEnable)->toBeFalsy();
});

test('return false if clientVersionNumber > demoVersionNumber', function () {
    $latestVersionUpgradeEnable = true;
    $productMode = 'DEMO';
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.3';
    $demoVersionNumber = '1.2.2';
    $alertVersionUpgradeEnable = $this->isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber);

    expect($alertVersionUpgradeEnable)->toBeFalsy();
});

test('alertVersionUpgradeEnable will true if all ok', function () {
    $latestVersionUpgradeEnable = true;
    $productMode = 'DEMO';
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.2';
    $demoVersionNumber = '1.2.3';
    $alertVersionUpgradeEnable = $this->isAlertVersionUpgradeEnable($latestVersionUpgradeEnable, $productMode, $minimumRequiredVersion, $clientVersionNumber, $demoVersionNumber);

    expect($alertVersionUpgradeEnable)->toBeTruthy();
});

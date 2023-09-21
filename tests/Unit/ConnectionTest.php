<?php

$targetURL = 'https://peopleprohrm.com/demo';
$wrongURL = 'https://peopleprohrm.com/xyz';

it('can test by PEST', function () {
    expect(true)->toBeTrue();
});

it('return true if url correct', function () use ($targetURL) {
    $result = $this->isServerConnectionOk($targetURL);
    expect($result)->toBeTruthy();
});

it('return false if url wrong', function () use ($wrongURL) {
    $result = $this->isServerConnectionOk($wrongURL);

    expect($result)->toBeFalsy();
});

it('return Object if connection is ok', function () use ($targetURL) {
    $result = $this->getDemoGeneralDataByCURL($targetURL);

    expect($result)->toBeObject();
});

it('return Null if connection is wrong', function () use ($wrongURL) {
    $result = $this->getDemoGeneralDataByCURL($wrongURL);

    expect($result)->toBeNull();
});

test('client version < minimum required version', function () {
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.0';
    $result = $this->isClientExceedMinimumRequiredVersion($minimumRequiredVersion, $clientVersionNumber);

    expect($result)->toBeFalsy();
});

test('client version === minimum required version', function () {
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.1';
    $result = $this->isClientExceedMinimumRequiredVersion($minimumRequiredVersion, $clientVersionNumber);

    expect($result)->toBeTruthy();
});

test('client version > the minimum required version', function () {
    $minimumRequiredVersion = '1.2.1';
    $clientVersionNumber = '1.2.3';
    $result = $this->isClientExceedMinimumRequiredVersion($minimumRequiredVersion, $clientVersionNumber);

    expect($result)->toBeTruthy();
});

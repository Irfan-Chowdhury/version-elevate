<?php

it('can test by PEST', function () {
    expect(true)->toBeTrue();
});

it('returns correct view', function() {
    // Act & Assert
    $this->get(route('developer-section.index'))
        ->assertOk()
        ->assertViewIs('version-elevate::developer_section.index');
});

test('page render successfully', function () {
    $response = $this->get('/developer-section');
    $response->assertStatus(200);
});


/*
|--------------------------------------------------------------------------
| Validation During Update
|--------------------------------------------------------------------------
|
*/
test('version - required | string | Version Number Format', function () {
    // $this->withoutExceptionHandling();

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['version' => '']))
        ->assertInvalid(['version' => 'required']);

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['version' => 1.2]))
        ->assertSessionHasErrors('version');

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['version' => '1.2']))
        ->assertSessionHasErrors('version');
});

test('minimum_required_version - required | string | Version Number Format', function () {
    // $this->withoutExceptionHandling();

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['minimum_required_version' => '']))
        ->assertInvalid(['minimum_required_version' => 'required']);

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['minimum_required_version' => 1.2]))
        ->assertSessionHasErrors('minimum_required_version');

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['minimum_required_version' => '1.2']))
        ->assertSessionHasErrors('minimum_required_version');
});

test('version_upgrade_base_url - required | string | Version Number Format', function () {
    // $this->withoutExceptionHandling();

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['version_upgrade_base_url' => '']))
        ->assertInvalid(['version_upgrade_base_url' => 'required']);

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['version_upgrade_base_url' => 'test']))
        ->assertSessionHasErrors('version_upgrade_base_url');
});


test('minimum version is less than <= Demo version', function () {
    // $this->withoutExceptionHandling();

    $this->post(route('developer-section.submit'), array_merge(generalData(), ['minimum_required_version'=>'1.2.5', 'version' => '1.2.0']))
    ->assertSessionHasErrors('version');
});

/*
|--------------------------------------------------------------------------
| Store
|--------------------------------------------------------------------------
|
*/

test('Developer Section Store', function () {
    // $this->withoutExceptionHandling();
    $response = $this->post(route('developer-section.submit'), generalData());
    $response->assertStatus(200);
});




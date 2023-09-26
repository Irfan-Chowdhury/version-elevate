<?php

namespace IrfanChowdhury\VersionElevate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use IrfanChowdhury\VersionElevate\Rules\GreaterThanMinVersion;
use IrfanChowdhury\VersionElevate\Rules\VersionNumber;

class DeveloperSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'minimum_required_version' => ['required', 'string', new VersionNumber],
            'version' => ['required','string', new VersionNumber, new GreaterThanMinVersion($this->minimum_required_version)],
            'version_upgrade_base_url' => 'required|url',
        ];
    }
}

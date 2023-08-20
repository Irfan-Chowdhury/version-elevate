<?php

namespace IrfanChowdhury\VersionElevate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'version' => 'required'
        ];
    }
}

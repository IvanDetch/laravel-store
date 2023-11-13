<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
//            'path' => 'required|array',
            //'gallery_id' => 'required|integer',
            'path' => 'array',
            //'path' => 'array',
            'path.*' => 'string',
            //'path' => 'required|string',
        ];
    }
}

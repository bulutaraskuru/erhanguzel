<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title_small' => 'required',
            'title_big' => 'required',
            'link_type' => 'required',
            'link' => 'required',
            'img' => request()->isMethod('put') ? 'nullable|mimes:png,jpg,jpeg|max:10000' : 'required|mimes:png,jpg,jpeg|max:10000',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => \Lang::get('validation.required'),
            'unique' => \Lang::get('validation.unique'),
            'mimes' => \Lang::get('validation.mimes'),
            'max' => \Lang::get('validation.max'),
        ];
    }
}

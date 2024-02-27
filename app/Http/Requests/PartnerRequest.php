<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'title' => 'required|unique:partners,title,'.$this->id,
            'description' => 'required',
            'img' => request()->isMethod('put') ? 'nullable|mimes:png,jpg,jpeg|max:4000' : 'required|mimes:png,jpg,jpeg|max:4000',
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

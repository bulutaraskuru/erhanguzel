<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'password' => request()->isMethod('put') ? 'nullable|min:8|string|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/' : 'required|min:8|string|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            'role' => request()->isMethod('put') ? 'nullable' : 'required',
            'email' => request()->isMethod('put') ? 'nullable|unique:users,email,'.$this->id : 'required|unique:users',
        ];
    }

    public function messages(): array
    {
        return [
            'string' => \Lang::get('validation.string'),
            'min' => \Lang::get('validation.min'),
            'required' => \Lang::get('validation.required'),
            'unique' => \Lang::get('validation.unique'),
        ];
    }
}

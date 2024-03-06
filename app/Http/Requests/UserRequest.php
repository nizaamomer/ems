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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'permissions' => 'required',
                'image' => 'sometimes|mimes:png,jpg,jpeg',
                'password' => 'required|confirmed|min:8',
            ];
        } else if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [    
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,'.$this->route('user')->id,
                'permissions' => 'required',
                'image' => 'sometimes|mimes:png,jpg,jpeg',
                'password' => 'required|min:8'
            ];
        }
    }
}

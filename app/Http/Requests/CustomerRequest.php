<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20,full_name' . $this->id,
            'pass' => 'required|min:6|max:20,password' . $this->id,
            'address' => 'required',
            'phone' => 'required|numeric|min:10,phone,' . $this->id,
            'email' => 'required|unique:customers,email,'. $this->id,
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name' => 'required|string',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'display_name' => 'required|string',
                        'description' => 'required|string',
                        'first_name' => 'required|string',
                        'last_name' => 'required|string',
                        'email' => 'required|string',
                        'phone' => 'required|string',
                        'city' => 'required|string',
                        'state' => 'required|string',
                        'zip_code' => 'required|string',
                        'address' => 'required|string',

                    ];
                }
            default:break;
            }
    }
}

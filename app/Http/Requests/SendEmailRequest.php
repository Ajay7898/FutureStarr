<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
        $rules_array = [
               'first_name' => 'required',
               'last_name' => 'required',
               'subject' => 'required',
               'message' => 'required',
        ]; 

        switch ($this->send) {
            case 'send_all':
                $rules =  $rules_array;
                break;
            case 'send':
                $rule = ['to' => 'required'];
                $rules =  array_merge($rules_array , $rule);
                break;
            default:
                $rules = [];
        }

          return $rules;
    }
}

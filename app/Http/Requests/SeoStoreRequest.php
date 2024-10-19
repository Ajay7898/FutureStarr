<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoStoreRequest extends FormRequest
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
             'url' => 'required',
             'page_name' => 'required|unique:metatags,page_title',
             'title' => 'required',
             'keyword' => 'required',
             'description' => 'required',
             'page' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
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

               'title' => 'required|unique:blog_contents,title',
               'feature_image' => 'mimes:jpeg,jpg,png,gif|required',
               'encode_image' => 'required',
               'feature_video' => 'sometimes|mimes:mp4,wav|required',
               'content' => 'required',
               'author_image' => 'sometimes|mimes:jpeg,jpg,png,gif|required',
               'author_first_name' => 'required',
               'author_last_name' => 'required',
               'meta-tags' => 'required',
               'meta-keywords' => 'required',
               'meta-description' => 'required',
               'category' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [

            'title.required' => 'Blog title is required.',
            'feature_image.required' => 'Image required.',
            'encode_image.required' => 'You must have to crop the author image.',
            'feature_video.required' => 'Video required.',
            'content.required' => 'Blog content is required.',
            'author_image.required' => 'Author image required.',
            'author_first_name' => 'First name required',
            'author_last_name' => 'Last name required',
            'meta-tags.required' => 'Blog meta tags is required.',
            'meta-keywords.required' => 'Blog meta keyword is required.',
            'meta-description.required' => 'Blog meta description required,',
            'category.required' => 'Blog category is required.',
        ];
    }
}

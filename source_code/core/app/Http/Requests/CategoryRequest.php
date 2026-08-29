<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if ($this->slug) {
            $this->merge(['slug' => \Illuminate\Support\Str::slug($this->slug)]);
        } elseif ($this->name) {
            $this->merge(['slug' => \Illuminate\Support\Str::slug($this->name)]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = $this->category ? ',' . $this->category->id : '';
        $required = $this->category ? '' : 'required';

        return [
            'slug'      => [$required,'unique:categories,slug'. $id,'regex:/^[a-zA-Z0-9-]+$/'],
            'photo'     => [$required,'mimes:jpeg,jpg,png,svg,avif,webp'],
            'name'      => 'required|max:255',
            'meta_keywords'=> 'max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'slug.required'  => __('Slug field is required.'),
            'slug.unique'    => __('This slug has already been taken.'),
            'slug.regex'     => __('Slug Must Not Have Any Special Characters.'),
            'photo.required' => __('Image field is required.'),
            'photo.mimes'    => __('Image type must be jpg,jpeg,png,svg,avif,webp.'),
        ];
    }
}

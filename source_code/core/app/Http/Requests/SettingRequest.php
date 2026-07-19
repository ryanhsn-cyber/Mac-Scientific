<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        if(isset($this->is_validate)){
            return [
                'title' => 'required|max:255',
                'footer_address' => 'required|max:255',
                'footer_phone' => 'required|max:255',
                'footer_email' => 'required|max:255',
                'copy_right' => 'required|max:255',
                'friday_start' => 'required|max:255',
                'friday_end' => 'required|max:255',
                'satureday_start' => 'required|max:255',
                'satureday_end' => 'required|max:255',
                'logo' => 'mimes:jpeg,jpg,png,svg,avif,webp',
                'loader' => 'mimes:jpeg,jpg,png,svg,avif,webp,gif',
                'favicon' => 'mimes:jpeg,jpg,png,svg,avif,webp,ico',
                'feature_image' => 'mimes:jpeg,jpg,png,svg,avif,webp',
                'home_background' => 'mimes:jpeg,jpg,png,svg,avif,webp',
                'breadcumb_background' => 'mimes:jpeg,jpg,png,svg,avif,webp',
                'footer_background' => 'mimes:jpeg,jpg,png,svg,avif,webp',
                'popup_banner' => 'mimes:jpeg,jpg,png,svg,avif,webp',
                'footer_gateway_img' => 'mimes:jpeg,jpg,png,svg,avif,webp'
            ];
        }else{
            return [

            ];
        }

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'logo.mimes'    => __('Logo Image type must be jpg,jpeg,png,svg,avif,webp.'),
            'loader.mimes'    => __('Loader Image type must be jpg,jpeg,png,svg,gif,avif,webp.'),
            'favicon.mimes'    => __('Favicon Image type must be jpg,jpeg,png,svg,ico,avif,webp.'),
            'feature_image.mimes'    => __('Feature Image type must be jpg,jpeg,png,svg,avif,webp.'),
            'home_background.mimes'    => __('Background Image type must be jpg,jpeg,png,svg,avif,webp.'),
            'breadcumb_background.mimes'    => __('Background Image type must be jpg,jpeg,png,svg,avif,webp.'),
            'footer_background.mimes'    => __('Background Image type must be jpg,jpeg,png,svg,avif,webp.'),
            'popup_banner.mimes'    => __('Popup Banner must be jpg,jpeg,png,svg,avif,webp.'),
        ];
    }

}

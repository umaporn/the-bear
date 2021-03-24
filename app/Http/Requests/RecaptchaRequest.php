<?php
/**
 * Recaptcha request validation
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * This class validates recaptcha request object.
 * @package App\Http\Requests
 */
class RecaptchaRequest extends FormRequest
{
    /**
     * Determine if the authenticated user is authorized to make this request.
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
     * @return array Rules
     */
    public function rules()
    {
        return [
            'g-recaptcha-response' => config( 'validation.recaptcha.g-recaptcha-response' ),
        ];
    }

}
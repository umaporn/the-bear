<?php
/**
 * ConsentRegister request validation
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsentRegisterRequest extends FormRequest
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
        return config( 'validation.consent_request' );
    }

}

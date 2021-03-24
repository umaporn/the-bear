<?php
/**
 * Item request validation
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validate item request object.
 * @package App\Http\Requests
 */
class ItemRequest extends FormRequest
{
    /**
     * Determine if the traveling document is authorized to make this request.
     *
     * @return bool true = authorized, false = unauthorized
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
        return config( 'validation.travelling_item' );
    }
}

<?php
/**
 * traveling document request validation
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validate traveling document request object.
 * @package App\Http\Requests
 */
class UpdateDocumentStatusRequest extends FormRequest
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
        return config( 'validation.traveling_document_status' );
    }
}

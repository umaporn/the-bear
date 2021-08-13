<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'zero_or_exists'       => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'checkbox_in'          => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file'    => 'The :attribute must not be greater than :max kilobytes.',
        'string'  => 'The :attribute must not be greater than :max characters.',
        'array'   => 'The :attribute must not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',
    'correct_password'     => 'The :attribute is not correct.',
    'ends_with'            => 'The :attribute must be allowed domain',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attachment_file'           => [
            'mimetypes' => 'The :attribute must be a file of type .doc, .docx, .pdf only',
        ],
        'firstname.*'               => [
            'required' => 'Please fill firstname',
        ],
        'lastname.*'                => [
            'required' => 'Please fill lastname',
        ],
        'email.*'                   => [
            'required' => 'Please fill email',
        ],
        'mobile.*'                  => [
            'required' => 'Please fill mobile',
            'unique'   => 'This mobile phone has already been taken.',
        ],
        'interest_project.*'        => [
            'required' => 'Please fill interest project',
        ],
        'prefer_language.*'         => [
            'required' => 'Please fill prefer language',
        ],
        'name.*'                    => [
            'unique' => 'This name has already been taken.',
        ],
        'requester_name'            => [
            'required' => 'Please fill requester name.',
        ],
        'requester_company_code'    => [
            'required' => 'Please fill requester company name.',
        ],
        'requester_department_code' => [
            'required' => 'Please fill requester department name.',
        ],
        'requester_employee_id'     => [
            'required' => 'Please fill requester employee id.',
        ],
        'terms_accept'              => [
            'required' => 'Please accept terms and conditions.',
        ],
        'budget_type'               => [
            'required' => 'Please select budget type.',
        ],
        'budget_company_code'       => [
            'required' => 'Please select budget company.',
        ],
        'travelling_to'             => [
            'required' => 'Please fill travelling to.',
        ],
        'travelling_from'           => [
            'required' => 'Please fill travelling from.',
        ],
        'vehicle_type'              => [
            'required' => 'Please select vehicle type.',
        ],
        'budget_department_code'    => [
            'required_if' => 'Please select department budget when :other is :value.',
        ],
        'budget_project_code'       => [
            'required_if' => 'Please select project budget when :other is :value.',
        ],
        'mile_number'               => [
            'required' => 'Please fill mile number.',
        ],
        'milerate_price'            => [
            'required' => 'Please fill milerate price.',
        ],
        'milerate_subtype'          => [
            'required' => 'Please fill milerate type.',
        ],
        'taxi_price'                => [
            'required' => 'Please fill taxi price.',
        ],
        'taxi_subtype'              => [
            'required' => 'Please fill taxi type.',
        ],
        'biketaxi_price'            => [
            'required' => 'Please fill biketaxi price.',
        ],
        'biketaxi_subtype'          => [
            'required' => 'Please fill biketaxi subtype.',
        ],
        'bts_price'                 => [
            'required' => 'Please fill bts price.',
        ],
        'mrt_price'                 => [
            'required' => 'Please fill mrt price.',
        ],
        'arl_price'                 => [
            'required' => 'Please fill arl price.',
        ],
        'parking_fileupload'        => [
            'required_without' => 'Please upload parking receipt.',
        ],
        'parking_price'             => [
            'required' => 'Please fill parking price.',
        ],
        'tollfee_fileupload'        => [
            'required_without' => 'Please upload tollfee receipt.',
        ],
        'tollfee_price'             => [
            'required' => 'Please fill tollfee price.',
        ],
        'invoice_number'            => [
            'required' => 'Please fill invoice number.',
        ],
        'oilbill_fileupload'        => [
            'required_without' => 'Please upload oilbill receipt.',
        ],
        'oilbill_price'             => [
            'required' => 'Please fill oilbill price.',
        ],
        'other_vehicle_name'        => [
            'required' => 'Please fill other vehicle name.',
        ],
        'other_vehicle_price'       => [
            'required' => 'Please fill other vehicle price.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'email' => 'e-mail address',
    ],

];

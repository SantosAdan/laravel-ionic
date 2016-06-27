<?php

namespace CodeDelivery\Http\Requests;

use CodeDelivery\Http\Requests\Request;

class AdminClientRequest extends Request
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
            'user.name' => 'required|min:3|max:50',
            'user.email' => 'required|email',
            'phone' => 'numeric',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required|numeric'
        ];
    }
}

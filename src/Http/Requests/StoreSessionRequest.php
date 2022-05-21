<?php

namespace Schoolarize\Schoolarizer\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class StoreSessionRequest extends FormRequest
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
            'name' => 'required|max:20|unique:school_sessions,name',
            'start_date' => 'required|unique:school_sessions,start_date',
            'end_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The session name must be unique, Name provided has been taken',
            'start_date.unique' => 'There is already a session with the same start date.'
        ];
    }
}

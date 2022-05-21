<?php

namespace Schoolarize\Schoolarizer\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class StoreTermRequest extends FormRequest
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
            'term' => 'required|max:20|unique:term_or_semester,term',
            'start_date' => 'required|unique:term_or_semester,start_date',
            'end_date' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'term.unique' => 'Each term must have a unique name',
            'start_date.unique' => 'There is a term with this date.'
        ];
    }
}

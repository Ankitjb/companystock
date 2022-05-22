<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
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
            'company_symbol' => ["required","alpha"],
            'start_date' => ["required"],
            'end_date' => ["required","after_or_equal:start_date","before:tomorrow"],
            'email' => ["required","email"],
        ];
    }
}

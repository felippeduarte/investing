<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestmentProductRequest extends FormRequest
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
            'name' => 'required',
            'financial_institution_id' => 'required|numeric|exists:financial_institutions,id',
            'investment_type_id' => 'required|numeric|exists:investment_types,id',
            'risk_level_id' => 'required|numeric|exists:risk_levels,id',
        ];
    }
}

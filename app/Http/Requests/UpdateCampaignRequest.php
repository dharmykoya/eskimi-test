<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends CreateCampaignRequest
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
        $rules = parent::rules();

        $rules['name'] = ['sometimes', 'required'];
        $rules['daily_budget'] = ['sometimes', 'required'];
        $rules['total_budget'] = ['sometimes', 'required'];
        $rules['start_date'] = ['sometimes', 'required'];
        $rules['end_date'] = ['sometimes', 'required'];
        $rules['banners'] = ['nullable'];
        return $rules;
    }
}

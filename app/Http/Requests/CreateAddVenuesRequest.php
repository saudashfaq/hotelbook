<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddVenuesRequest extends FormRequest
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
            'venue_name' => 'required',
            'venue_type' => 'required',
            'min_guests' => 'required',
            'max_guests' => 'required',
            'days' => 'required',
            'available_time' => 'required',
            'max_occupied_time' => 'required',
        ];
    }
}

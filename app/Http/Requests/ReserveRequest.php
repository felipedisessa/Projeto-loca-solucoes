<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'           => 'required',
            'email'          => 'required|email',
            'phone'          => 'required',
            'mobile'         => 'required',
            'cpf_cnpj'       => 'required',
            'company'        => 'required',
            'street'         => 'required',
            'number'         => 'required',
            'city'           => 'required',
            'state'          => 'required',
            'zipcode'        => 'required',
            'country'        => 'required',
            'start'          => 'required',
            'end'            => 'required',
            'rental_item_id' => 'required',
            'title'          => 'required',
            'description'    => 'required',
            'start_time'     => 'required',
            'end_time'       => 'required',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'country' => 'required|string|in:CZ,SK,DE,PL',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|digits:5',
            'phone' => 'required|numeric',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        $input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $input['firstName'] = filter_var($input['firstName'], FILTER_SANITIZE_STRING);
        $input['lastName'] = filter_var($input['lastName'], FILTER_SANITIZE_STRING);
        $input['company'] = filter_var($input['company'], FILTER_SANITIZE_STRING);
        $input['address'] = filter_var($input['address'], FILTER_SANITIZE_STRING);
        $input['city'] = filter_var($input['city'], FILTER_SANITIZE_STRING);
        $input['zip'] = filter_var($input['zip'], FILTER_SANITIZE_NUMBER_INT);
        $input['phone'] = filter_var($input['phone'], FILTER_SANITIZE_NUMBER_INT);

        $this->replace($input);
    }

    protected function prepareForValidation()
    {
        $this->sanitize();
    }

    public function messages()
    {
        return [
            'email.required' => 'Toto pole je povinné',
            'email.email' => 'E-mailová adresa není platná',
            'firstName.required' => 'Toto pole je povinné',
            'lastName.required' => 'Toto pole je povinné',
            'address.required' => 'Toto pole je povinné',
            'city.required' => 'Toto pole je povinné',
            'zip.required' => 'Toto pole je povinné',
            'zip.digits' => 'PSČ musí být přesně 5 číslic',
            'phone.required' => 'Toto pole je povinné',
            'phone.numeric' => 'Telefonní číslo musí být číselné',
        ];
    }
}

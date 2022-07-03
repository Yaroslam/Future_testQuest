<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use \Illuminate\Contracts\Validation\Validator;

class StoreNotebookRequest extends FormRequest
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
     * @return array<string, mixed>
     */

    public function rules(){
        return [
            'FCs' => 'required|string',
            'mob_phone' => ['required','string','regex: /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'],
            'company' => '',
            'email' => 'required|email|unique:notebook,email',
            'photo_path' => ['string','regex: /^.*\.(jpg|JPG|png|PNG|)$/'],
            'birthdate' => 'date',
        ];
    }


    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }






}

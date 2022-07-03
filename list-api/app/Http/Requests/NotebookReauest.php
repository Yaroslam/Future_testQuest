<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class NotebookReauest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        return [
            'FCs' => 'required|string',
            'mob_phone' => 'required|string',
            'company' => 'string|integer',
            'email' => 'required|string',
            'photo_path' => 'string',
            'birthdate' => 'date',


        ];



    }
}

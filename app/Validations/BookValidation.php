<?php

namespace App\Validations;

class BookValidation
{


    public function rules()
    {
        return [
            'title' => 'required',
            'author' => 'required|notEmpty'
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Le champ titre est requis',
            'author.required' => 'Le champ auteur est requis',
            'author.notEmpty' => 'Le champ auteur ne peut être vide'
        ];
    }
}

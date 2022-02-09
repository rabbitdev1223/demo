<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'password' => 'la password è errata.',
    'required' => 'il campo :attribute è richiesto.',
    'same' => 'i campi :attribute e :other devono combaciare.',
    'size' => [
        'numeric' => 'Il :attribute dovrebbe essere :size.',
        'file' => 'Il :attribute deve essere :size kilobytes.',
        'string' => 'Il :attribute deve essere :size caratteri.',
        'array' => 'Il :attribute deve contenere :size items.',
    ],
    'string' => 'The :attribute must be a string.',
    'unique' => 'Il :attribute già è utilizzato.',
    
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */
    'attributes' => [
        'password' => 'Password',
        'name'=>'Nome',
        'color'=>'Colore',
        'password_confirmation'=>'Conferma password',
        'birth_date_of_couple'=>'Birth Date',
        'male_parrot' => "Pappagallo maschio",
        'female_parrot' => "Pappagallo femmina",
        "couple_made_today" => "I pappagalli sono stati messi insieme oggi",
        'expected_date_of_birth'=>"Data stimata di nascita",
        'breed' => 'Razza',
        'parrot' => 'Pappagallo',
        "surname" => 'Cognome',
        
    ]
];

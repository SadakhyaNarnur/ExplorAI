<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $useTimestamps = true;
    protected $returnType    = 'App\Entities\User';
    protected $validationRules    = [
        'name'     => 'required|min_length[3]',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password'     => 'required|min_length[6]',
    ];

    protected $validationMessages = [
        'name'        => [
            'required' => 'Le champ Nom & Prénom est obligatoire',
            'min_length' => 'Le champ Nom & Prénom doit contenir au moins 3 caractéres'
        ],
        'password' => [
            'required' => 'Le champ mot de passe est obligatoire',
            'min_length' => 'Le champ mot de passe doit contenir au moins 6 caractéres'
        ],
        'email' => [
            'required' => 'Le champ email est obligatoire',
            'valid_email' => 'Veuillez saisir une adresse email valide',
            'is_unique' => 'Email déja utilisé !'
        ],
    ];

    protected $allowedFields = ["name", "email", "password"];
}

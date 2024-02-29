<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;

class Register extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel;
    }

    public function registerForm()
    {
        return view('users/register');
    }

    public function store()
    {
        $user = new User($this->request->getPost());

        if (strlen($user->password) >= 6) {
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        }

        if ($this->model->insert($user)) {
            return redirect()->to("/posts")->with("success", "Account created");
        } else {
            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }
}

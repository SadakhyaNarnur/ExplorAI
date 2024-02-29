<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;

class Login extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel;
    }

    public function loginForm()
    {
        return view('users/login');
    }

    public function auth()
    {
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");

        $user = $this->model->where('email', $email)->first();

        if ($user !== null) {
            if (password_verify($password, $user->password)) {
                $session = session();
                $session->regenerate();
                $session->set("logged", true);
                $session->set("user_id", $user->id);
                $session->set("name", $user->name);
                $session->set("admin", $user->is_admin);
                return redirect()->to("/")
                    ->with('success', 'Connected');
            } else {
                return redirect()->back()
                    ->with('error', 'Invalid credentials')
                    ->withInput();
            }
        } else {
            return redirect()->back()
                ->with('error', 'Invalid credentials')
                ->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to("/");
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    private $model;
    private $user;

    public function __construct()
    {
        $this->model = new UserModel;
        $this->user = $this->model->find(session("user_id"));
    }

    public function index()
    {
        if ($this->user->id === session("user_id")) {
            return view('users/profile', [
                "user" => $this->user
            ]);
        }
    }

    public function editProfileForm()
    {
        if ($this->user->id === session("user_id")) {
            return view('users/edit', [
                "user" => $this->user
            ]);
        }
    }

    public function updateProfile()
    {
        $this->user->fill($this->request->getPost());

        if ($this->user->id === session("user_id")) {
            if ($this->user->hasChanged('name') || $this->user->hasChanged('email')) {
                if ($this->model->save($this->user)) {
                    $session = session();
                    $session->set("name", $this->user->name);
                    return redirect()->to("/profile")->with("success", "Profile updated");
                } else {
                    return redirect()->back()
                        ->with('errors', $this->model->errors())
                        ->withInput();
                }
            } else {
                return redirect()->back()
                    ->with('error', "Nothing changed !")
                    ->withInput();
            }
        } else {
            return redirect()->to("/");
        }
    }

    public function editUserPassword()
    {
        if ($this->user->id === session("user_id")) {
            return view('users/edit-password');
        }
    }

    public function updatePassword()
    {
        $password = $this->request->getPost("current_password");
        if (!password_verify($password, $this->user->password)) {
            return redirect()->back()
                ->with('error', "Invalid password !")
                ->withInput();
        }

        if ($this->user->id === session("user_id")) {
            $this->model->update($this->user->id, [
                "password" => password_hash($this->request->getPost("new_password"), PASSWORD_DEFAULT)
            ]);
            session_destroy();
            return redirect()->to("/");
        } else {
            return redirect()->to("/");
        }
    }
}

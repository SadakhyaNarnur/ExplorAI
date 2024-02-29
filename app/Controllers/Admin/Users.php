<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;

class Users extends \App\Controllers\BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel;
    }

    public function index()
    {
        return view('admin/users/index', [
            "users" => $this->model->orderBy("id")->paginate(5),
            "pager" => $this->model->pager
        ]);
    }

    public function delete($id)
    {
        $user = $this->model->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("L'utilisateur $id est introuvable !");
        }

        if (session("admin")) {
            $this->model->delete($id);
            return redirect()->to("/admin/users")->with("success", "Utilisateur supprimé avec succés");
        }
        return redirect()->to("/");
    }

    public function update($id)
    {
        $user = $this->model->find($id);

        if (session("admin")) {
            $this->model->protect(false);
            if ($user->is_admin) {
                if ($this->model->update($id, [
                    "is_admin" => 0
                ])) {
                    return redirect()->to("/admin/users")->with("success", "Admin retiré");
                } else {
                    return redirect()->back()
                        ->with('errors', $this->model->errors());
                }
            } else {
                if ($this->model->update($id, [
                    "is_admin" => 1
                ])) {
                    return redirect()->to("/admin/users")->with("success", "Admin ajouté");
                } else {
                    return redirect()->back()
                        ->with('errors', $this->model->errors());
                }
            }
        } else {
            return redirect()->to("/");
        }
    }
}

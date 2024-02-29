<?php

namespace App\Controllers\Admin;

use App\Models\PostModel;

class Posts extends \App\Controllers\BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new PostModel;
    }

    public function index()
    {
        return view('admin/posts/index', [
            "posts" => $this->model->orderBy("likes","created_at","DESC")->paginate(5),
            "pager" => $this->model->pager
        ]);
    }

    public function delete($id)
    {
        $post = $this->model->find($id);

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("The article $id is not available!");
        }

        if (session("admin")) {
            $this->model->delete($id);
            return redirect()->to("/admin/posts")->with("success", "Article supprimé avec succés");
        }
        return redirect()->to("/");
    }
}

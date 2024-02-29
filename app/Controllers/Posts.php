<?php

namespace App\Controllers;

use App\Entities\Post;
use App\Models\PostModel;
use App\Models\UserModel;

class Posts extends BaseController
{
    private $model;
    private $user_id;

    public function __construct()
    {
        $this->model = new PostModel;
        $this->user_id = session("user_id");
    }
    // public function index()
	// {
	// 	return view('home/index', [
	// 		"posts" => $this->model->orderBy("likes", "DESC")->orderBy("created_at", "DESC")->paginate(5),
	// 		"pager" => $this->model->pager,
	// 		"controller" => $this
	// 	]);
	// }

    public function index()
    {
        // $posts =  $this->model->getUserPosts($this->user_id);
        return view('posts/index', [
            "posts" => $this->model->orderBy("likes", "DESC")->orderBy("created_at", "DESC")->paginate(3),
            "pager" => $this->model->pager,
            "controller" => $this
        ]);
    }

    public function show($id)
    {
        $post = $this->model->find($id);
        $owner = $post->user_id === session("user_id");
        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Article $id not found !");
        }
        return view('posts/show', [
            "post" => $post,
            "owner" => $owner,
            "controller" => $this
        ]);
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
        //check input file not empty
        $file = $this->request->getFile('image');
        if (!$file->isValid()) {
            $error_code = $file->getError();
            if ($error_code == UPLOAD_ERR_NO_FILE) {
                return redirect()->back()
                    ->with('error', "Select an image !")
                    ->withInput();
            }
        }
        //check file size
        $fileSize = $file->getSizeByUnit("mb");
        if ($fileSize > 2) {
            return redirect()->back()
                ->with('error', "file size exceeded max size 2MB!")
                ->withInput();
        }
        //check file type (png,jpg,jpeg)
        $type = $file->getMimeType();
        $types = ["image/png", "image/jpg", "image/jpeg"];
        if (!in_array($type, $types)) {
            return redirect()->back()
                ->with('error', "choose a valid image file")
                ->withInput();
        }

        $tagsArray = $this->request->getVar('tags');  // Array
        $tagsString = json_encode($tagsArray);    // String

        //upload the valid file
        $file->move("./posts_images");
        $post = new Post($this->request->getPost());
        $post->tags = $tagsString;
        $post->user_id = session("user_id");
        $post->post_image = $file->getName();
        $added = $this->model->insert($post);
        if ($added) {
            return redirect()->to("/posts")->with("Success", "Article added", );
        } else {
            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }
    
    public function likePost($id)
    {
        // Find the post by its ID
        $post = $this->model->find($id);
        print_r($post);
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }
        else{
            $likes = $post->likes + 1;
            $post->likes = $likes;
            $this->model->save($post);
            return redirect()->back()->with('success', 'Post Liked');
            } 
    }


    public function edit($id)
    {
        $post = $this->model->find($id);
        if ($post->user_id === session("user_id")) {
            return view('posts/edit', ["post" => $post]);
        }
        return redirect()->to("/");
    }

    public function update($id)
    {
        $post = $this->model->find($id);
        $post->fill($this->request->getPost());
        if ($post->user_id === session("user_id")) {
            if ($post->hasChanged('title') || $post->hasChanged('description')) {
                if ($this->model->save($post)) {
                    return redirect()->to("/posts")->with("success", "Article updated");
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
 
    public function delete($id)
    {
        $post = $this->model->find($id);

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Article $id not found !");
        }


        if ($post->user_id === session("user_id")) {
            $this->model->delete($id);
            return redirect()->to("/posts")->with("success", "Article deleted");
        }
        return redirect()->to("/");
    }

    public function getUserById($id)
    {
        $userModel = new UserModel;
        $user = $userModel->find($id);
        return $user->name;
    }
}

<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;

class Home extends BaseController
{
	private $model;

	public function __construct()
	{
		$this->model = new PostModel;
	}

	public function index()
	{
		return view('home/index', [
			"posts" => $this->model->orderBy("likes", "DESC")->orderBy("created_at", "DESC")->paginate(5),
			// "pager" => $this->model->pager,
			"controller" => $this
		]);
	}

	public function getUserById($id)
	{
		$userModel = new UserModel;
		$user = $userModel->find($id);
		return $user->name;
	}
}

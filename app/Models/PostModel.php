<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = "post";
    protected $useTimestamps = true;
    protected $returnType    = 'App\Entities\Post';
    protected $validationRules    = [
        'title'     => 'required|min_length[3]',
        'description' => 'required|min_length[10]'
    ];

    protected $validationMessages = [
        'title'        => [
            'required' => 'Requirement not satisfied for title',
            'min_length' => 'Minimum 3 characters'
        ],
        'description' => [
            'required' => 'Requirement not satisfied for description',
            'min_length' => 'Minimum 10 characters'
        ]
    ];

    protected $allowedFields = ["title", "description", "user_id", "post_image","tags","likes"];

    public function getUserPosts($user_id)
    {
        return $this->where('user_id', $user_id)
            ->orderBy("likes", "DESC")->orderBy("likes", "DESC")->orderBy("created_at", "DESC")
            ->findAll();
    }
}

<?php

namespace App\Http\Helpers\Interface;

use App\Models\SocialMediaAccount;

interface Platform
{
    public function getLikes();
    public function getMessages();
    public function getFollower();
    public function createPost($text);
    public function createPostImage($text,$image);
}

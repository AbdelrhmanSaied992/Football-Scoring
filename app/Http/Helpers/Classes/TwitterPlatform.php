<?php

namespace App\Http\Helpers\Classes;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Helpers\Interface\Platform;
use App\Models\SocialMediaAccount;
use Illuminate\Support\Facades\Log;

class TwitterPlatform implements Platform
{
    private SocialMediaAccount $account;
    private TwitterOAuth $provider;

    public function __construct(SocialMediaAccount $account)
    {

        $this->account = $account;

        $this->provider = new TwitterOAuth(
            config('services.twitter.client_id'),
            config('services.twitter.client_secret'),
            $this->account->user_token,
            $this->account->secrete_token,
        );
    }

    public function getLikes()
    {
        return $this->result(true,0);
    }

    public function getMessages()
    {
        return $this->result(true,[]);
    }

    public function getFollower()
    {
        return $this->result(true,0);
    }

    public function createPost($text)
    {
        $this->provider->setApiVersion('2');

        $this->provider->post('tweets', ['text' => $text]);

        if ($this->provider->getLastHttpCode() != 200) {

            return $this->result(false,$this->provider->getLastBody());

        }

        return $this->result(true,'Post has been created Successfully');
    }

    public function createPostImage($text,$image)
    {

        $absolutePath = realpath('../'.$image);

        $this->provider->setApiVersion('1.1');

        $this->provider->upload('media/upload',['media' => $absolutePath]);


        if ($this->provider->getLastHttpCode() != 200) {

            return $this->result(false,$this->provider->getLastBody());

        }

        $this->provider->setApiVersion('2');

        $media =
            [
                'media_ids' => [$this->provider->getLastBody()->media_id_string]
            ];

        $this->provider->post('tweets', ['text' => $text,'media'=>$media]);

        if ($this->provider->getLastHttpCode() != 200) {

            return $this->result(false,$this->provider->getLastBody());

        }

        return $this->result(true,'Post has been created Successfully');

    }

    private function result($status,$data):array
    {

        return
            [
                'status' => $status,
                'data' => $data,
            ];
    }
}

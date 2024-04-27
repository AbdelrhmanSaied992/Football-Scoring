<?php

namespace App\Http\Helpers\Classes;

use App\Http\Helpers\Interface\Platform;
use App\Models\SocialMediaAccount;
use Carbon\Carbon;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FaceBookPlatform implements Platform
{
    private SocialMediaAccount $account;
    private Facebook $provider;

    public function __construct(SocialMediaAccount $account)
    {

        $this->account = $account;

        $this->provider = new Facebook([
            'app_id' => config('services.facebook.client_id'),
            'app_secret' => config('services.facebook.client_secret'),
            'default_graph_version' => 'v18.0',
        ]);

    }

    public function getLikes()
    {

        try {

            $response = $this->provider->get('/'.$this->account->page_fb_id.'?fields=fan_count',$this->account->page_fb_token);

            return $this->result(true,$response->getDecodedBody()['fan_count']);

        } catch (FacebookResponseException $e) {

            return $this->result(false,$e->getMessage());

        } catch (FacebookSDKException $e) {

            return $this->result(false,$e->getMessage());

        }
    }

    public function getMessages()
    {

        try {

            $response = $this->provider->get('/me/conversations?fields=message',$this->account->page_fb_token);

            $conversations = $response->getDecodedBody()['data'];

            $lastMessages = [];

            $fields =
                [
                    'created_time',
                    'message',
                    'from',
                ];

            $fields = json_encode($fields);

            foreach ($conversations as $conversation)
            {
                $response = $this->provider->get('/'.$conversation['id'].'/messages?limit=1&fields='.$fields,$this->account->page_fb_token);

                $responsePicture = $this->provider->get('/'.$response->getDecodedBody()['data'][0]['from']['id'].'/picture'.'?type=large&redirect=false',$this->account->page_fb_token);

                $carbonDate = Carbon::parse($response->getDecodedBody()['data'][0]['created_time']);

                $message =
                    [
                        'msg' => $response->getDecodedBody()['data'][0]['message'],
                        'created_time' => $carbonDate->toDateTimeString(),
                        'user_name' => $response->getDecodedBody()['data'][0]['from']['name'],
                        'user_image' => $responsePicture->getDecodedBody()['data']['url'],
                        'platform' => 'Facebook',
                    ];

                $lastMessages [] = $message;
            }

            return $this->result(true,$lastMessages);

        } catch (FacebookResponseException $e) {

            return $this->result(false,$e->getMessage());

        } catch (FacebookSDKException $e) {

            return $this->result(false,$e->getMessage());

        }

    }

    public function getFollower()
    {

        try {

            $response = $this->provider->get('/'.$this->account->page_fb_id.'?fields=followers_count',$this->account->page_fb_token);

            return $this->result(true,$response->getDecodedBody()['followers_count']);

        } catch (FacebookResponseException $e) {

            return $this->result(false,$e->getMessage());

        } catch (FacebookSDKException $e) {

            return $this->result(false,$e->getMessage());

        }
    }

    public function createPost($text)
    {

        try {

            $response = $this->provider->post('/'.$this->account->page_fb_id.'/feed', ['message' => $text],$this->account->page_fb_token);

            return $this->result(true,'Post has been created Successfully');

        } catch (FacebookResponseException $e) {

            return $this->result(false,$e->getMessage());

        } catch (FacebookSDKException $e) {

            return $this->result(false,$e->getMessage());

        }

    }

    public function createPostImage($text,$image)
    {

        try {

            $imagePath = asset($image);

            $response = $this->provider->post('/'.$this->account->page_fb_id.'/photos', [
                'caption' => $text,
                'source' => $this->provider->fileToUpload($imagePath),
            ],$this->account->page_fb_token);

            return $this->result(true,'Post has been created Successfully');

        } catch (FacebookResponseException $e) {

            return $this->result(false,$e->getMessage());

        } catch (FacebookSDKException $e) {

            return $this->result(false,$e->getMessage());

        }
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

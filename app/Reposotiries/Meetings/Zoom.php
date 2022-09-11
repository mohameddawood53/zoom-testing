<?php

namespace App\Reposotiries\Meetings;
use Exception;

class Zoom implements MeetingInterface
{
    private $token;
    private $base_url = null;
    private $request;
    const USER_TYPE_BASIC = 1; //  - Basic.
    const USER_TYPE_LICENSED = 2; //  - Licensed.
    const USER_TYPE_ONPREM = 3; //  - On-prem.
    const USER_TYPE_FIXED_RECURRING_FIXED = 99;


    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
    public function __construct()
    {
        $this->token = $this->generateToken();
        $this->base_url = env('ZOOM_API_URL', 'https://api.zoom.us/v2/');
        $this->request = $this->meetingRequest();
    }

    private function generateToken()
    {
        $key = config('zoom.api_key');
        $secret = config('zoom.api_secret');
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];
//        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }

    private function meetingRequest()
    {
        return \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => 'Bearer ' . $this->token,
            'content-type' => 'application/json',
        ]);
    }

    public function createMeetingUser(array $data)
    {
        try {
            $response = $this->request->post($this->base_url . "users/" , [
                "action" => @$data['action'],
                "user_info" => [
                    'email' => $data['email'],
                    'type' => $data['type'] ?? self::USER_TYPE_BASIC,
                    'first_name' => $data['name'],
                    'last_name' => @$data['last_name'],
                ]
            ]);
            return $response->body();
        }catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function createMeeting(string $user_id,array $data)
    {
        try {
            $response = $this->request->post($this->base_url . 'users/'.$user_id.'/meetings' , [
                'type' => self::MEETING_TYPE_SCHEDULE,
                'topic' => @$data['topic'],
                'start_time' => $data['start_time'] ? new \DateTime($data['start_time']) : null,
                'duration' => @$data["duration"],
                'password' => @$data['password'],
                'agenda' => @$data['agenda'],
                'timezone' => $data['timezone'] ?? ('app.timezone'),
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                    'auto_recording' => $data['auto_recording'] ?? 'none'
                ]
            ]);
            return $response->body();
        }catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function listUserMeetings(string $id)
    {
        try {
            $response = $this->request->get($this->base_url . 'users/'.$id.'/meetings');
            return $response->body();
        }catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function listMeetingUsers (string $meeting_id){
        try {
            $response = $this->request->get($this->base_url . 'meetings/'.$meeting_id);
            return $response->body();
        }catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function getMeeting(string $meeting_id)
    {
        try {
            $response = $this->request->get($this->base_url . 'meetings/'.$meeting_id);
            return $response->body();
        }catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function deleteMeeting(string $meeting_id)
    {
        try {
            $response = $this->request->delete($this->base_url . 'meetings/' . $meeting_id);
            return $response->body();
        }catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }



}

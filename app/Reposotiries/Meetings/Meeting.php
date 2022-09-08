<?php

namespace App\Reposotiries\Meetings;

class Meeting
{
    private static $meeting;
    private static $instance;

    public function __construct(MeetingInterface $meeting = null)
    {
        self::$meeting = $meeting;
    }

    public static function Init(MeetingInterface $meeting)
    {
        self::$meeting = $meeting;
        if (!isset(self::$instance))
        {
            self::$instance = new Meeting(self::$meeting);
        }

        return self::$instance;
    }

    public function registerMeetingUser($data){
        return self::$meeting->createMeetingUser($data);
    } // end of register_meeting_user function

    public function listUserMeetings (string $id){
        return self::$meeting->listUserMeetings($id);
    } // end of listUserMeetings function

    public function listMeetingUsers (string $id){
        return self::$meeting->listMeetingUsers($id);
    } // end of listMeetingUsers function

    public function create(string $id,array $data){
        return self::$meeting->createMeeting($id , $data);
    } // end of createMeeting function

    public function get($id){
        return self::$meeting->getMeeting($id);
    } // end of getMeeting function

    public function deleteMeeting($id){
        return self::$meeting->deleteMeeting($id);
    } // end of deleteMeeting function



}

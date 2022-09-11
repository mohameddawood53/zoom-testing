<?php

namespace App\Reposotiries\Meetings;
/**
 * @method createMeetingUser(array $data)
 * @method createMeeting(string $user_id,array $data)
 * @method listUserMeetings(string $id)
 * @method listMeetingUsers (string $meeting_id)
 * @method getMeeting (string $meeting_id)
 * @method deleteMeeting(string $meeting_id)
 */
class Meeting
{
    private static MeetingInterface $meeting;
    private static self $instance;

    /**
     * @param MeetingInterface|null $meeting
     */
    public function __construct(MeetingInterface $meeting = null)
    {
        self::$meeting = $meeting;
    }

    /**
     * @param MeetingInterface $meeting
     * @return static
     */
    public static function Init(MeetingInterface $meeting) : self
    {
        self::$meeting = $meeting;
        if (!isset(self::$instance))
        {
            self::$instance = new Meeting(self::$meeting);
        }

        return self::$instance;
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        return self::$meeting->$method(...$arguments);
    }

//    public function registerMeetingUser($data){
//        return self::$meeting->createMeetingUser($data);
//    } // end of register_meeting_user function
//
//    public function listUserMeetings (string $id){
//        return self::$meeting->listUserMeetings($id);
//    } // end of listUserMeetings function
//
//    public function listMeetingUsers (string $id){
//        return self::$meeting->listMeetingUsers($id);
//    } // end of listMeetingUsers function
//
//    public function create(string $id,array $data){
//        return self::$meeting->createMeeting($id , $data);
//    } // end of createMeeting function
//
//    public function get($id){
//        return self::$meeting->getMeeting($id);
//    } // end of getMeeting function
//
//    public function deleteMeeting($id){
//        return self::$meeting->deleteMeeting($id);
//    } // end of deleteMeeting function



}

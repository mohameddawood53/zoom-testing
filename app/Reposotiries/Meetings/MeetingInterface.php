<?php

namespace App\Reposotiries\Meetings;

interface MeetingInterface
{
    public function createMeetingUser(array $data);

    public function createMeeting(string $user_id, array $data);

    public function listUserMeetings(string $id);

    public function listMeetingUsers(string $meeting_id);

    public function getMeeting(string $meeting_id);

    public function deleteMeeting(string $meeting_id);
}

<?php

// app/Services/ActivityService.php

namespace App\Services;

use App\Models\Activity;

class ActivityService
{
    public static function log($subject, $action, $user_id,$color)
    {
        Activity::create([
            'subject' => $subject,
            'action' => $action,
            'user_id' => $user_id,
            'color' => $color,
        ]);
    }
    public static function getAllActivities()
    {
        return Activity::orderBy('created_at', 'desc')->get();
    }
}

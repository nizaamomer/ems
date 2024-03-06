<?php

// app/Services/ActivityService.php

namespace App\Services;

use App\Models\Activity;

class ActivityService
{
    public static function log($subject, $action, $user_id)
    {
        Activity::create([
            'subject' => $subject,
            'action' => $action,
            'user_id' => $user_id,
        ]);
    }
    public static function getAllActivities()
    {
        return Activity::orderBy('created_at', 'desc')->get();
    }
}

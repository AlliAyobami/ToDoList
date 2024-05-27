<?php

namespace App\Services;

use App\Models\Task;
use DateTime;
use DateInterval;

class TimelineService
{
    /**
     * Calculate Task time interval
     * @param Task
     * @return DateInterval
     */
    public function calculateTaskProximity(Task $task): DateInterval
    {
        $currentDate = new DateTime('now');
        $dueDate = new DateTime($task->due_date);
        $difference = date_diff($currentDate, $dueDate);
        return $difference;
    }
}

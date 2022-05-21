<?php

namespace Schoolarize\Schoolarizer;

trait HasActivityLogs
{
    public function activityLogs()
    {
        return $this->morphMany('Schoolarize\Schoolarizer\Models\ActivityLog\ActivityLog', 'loggable');
    }

}
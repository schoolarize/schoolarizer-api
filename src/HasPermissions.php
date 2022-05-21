<?php

namespace Schoolarize\Schoolarizer;

trait HasPermissions
{
    public function permissions()
    {
        return $this->morphMany('Schoolarize\Schoolarizer\Models\Permission\Permission', 'assigned_to');
    }
}
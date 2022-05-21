<?php

namespace Schoolarize\Schoolarizer;

trait HasRoles
{
    public function roles()
    {
        return $this->morphMany('Schoolarize\Schoolarizer\Models\Role\Role', 'assigned_to');
    }
}
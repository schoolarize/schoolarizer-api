<?php

namespace Schoolarize\Schoolarizer\Models\Permission;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  protected $table = 'auth_permissions';

    public function assigned_to()
    {
        return $this->morphTo();
    }


}

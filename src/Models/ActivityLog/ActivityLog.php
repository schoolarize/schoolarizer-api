<?php

namespace Schoolarize\Schoolarizer\Models\ActivityLog;


use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{

  protected $table = 'activity_log';

  protected $guarded = [];

  public function loggable()
  {
      return $this->morphTo();
  }

}

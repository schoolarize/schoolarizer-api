<?php

namespace Schoolarize\Schoolarizer\Models\Session;
use Schoolarize\Schoolarizer\Models\Term\Term;



use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

  protected $table = 'school_sessions';

  protected $with = ['terms'];
  protected $fillable = ['name', 'start_date', 'end_date'];

  public function terms()
  {
    return $this->hasMany(Term::class, 'session_id');
  }


}

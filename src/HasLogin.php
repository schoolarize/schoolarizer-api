<?php

namespace Schoolarize\Schoolarizer;


trait HasLogin
{
    
    public function login()
    {
        return $this->morphOne('App\User', 'userable');
    }

}
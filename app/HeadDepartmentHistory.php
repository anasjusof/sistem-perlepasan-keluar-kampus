<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeadDepartmentHistory extends Model
{
    protected $fillable = [
        'users_id', 'lecturer_histories', 'approval_status', 
    ];
}

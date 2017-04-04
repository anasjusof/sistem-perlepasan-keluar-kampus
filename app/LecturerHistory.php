<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LecturerHistory extends Model
{
    protected $fillable = [
        'users_id', 'attachments_id', 'reason', 'approval_status', 'date_from', 'date_to', 
    ];
}

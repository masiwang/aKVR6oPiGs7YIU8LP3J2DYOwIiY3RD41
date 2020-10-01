<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $table = 'sii_log';
    protected $fillable = ['user_id', 'action', 'object', 'name'];
}

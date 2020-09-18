<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'sii_articles';
    protected $fillable = ['image_url','title', 'body', 'user_id', 'created_at', 'updated_at'];
}

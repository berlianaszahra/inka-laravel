<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminContent extends Model
{
    protected $fillable = ['title', 'category', 'status', 'body'];
}
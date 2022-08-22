<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// boilerplate
class Comment extends Model
{
    use HasFactory, SoftDeletes;

    public function post() {
        return $this->belongsTo(Post::class);
    }
}

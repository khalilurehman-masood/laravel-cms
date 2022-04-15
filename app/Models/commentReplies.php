<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentReplies extends Model
{
    use HasFactory;

    protected $grarded=[];

    public function comment(){
        return $this->belongsTo(comment::class);
    }
}

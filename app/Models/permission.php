<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function roles(){
        return $this->belongsToMany(role::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}

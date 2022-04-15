<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function permissions(){
        return $this->belongsToMany(permission::class);
        }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}

<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use sluggable;
    use HasFactory;
    protected $fillable=[
        'title',
        'body',
        'post_image',
        'user_id',
        'slug'
    ];

    protected $sluggable=[
        'built_from'=>'title',
        'save_to'=>'slug',
        'on_update'=>false
    ];

    public function sluggable(): array
{
    return [
        'slug' => [
            'source' => ['title','id']
        ]
    ];
}

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getPostImageAttribute($value){
        $value='/images/'.$value;
        return asset($value);
    }

    public function categories(){
        return $this->belongsToMany(category::class);
    }

    public function comments(){
        return $this->hasMany(comment::class);
    }
}

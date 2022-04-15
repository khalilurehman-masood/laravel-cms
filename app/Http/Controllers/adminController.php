<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\comment;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    public function index(){
        $postsCount=post::count();
        $categoriesCount=category::count();
        $commentsCount=comment::count();
        $usersCount=User::count();
        return view('admin.index',compact('postsCount','categoriesCount','commentsCount','usersCount'));
    }
}

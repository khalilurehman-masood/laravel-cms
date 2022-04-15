<?php

namespace App\Http\Controllers;

use App\Models\permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $permissions=permission::all();
        return view('admin.rolesAndPermissions.permissions',compact('permissions'));
    }
}

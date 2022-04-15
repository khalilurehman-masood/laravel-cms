<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index(){
        $roles=role::all();
        return view('admin.rolesAndPermissions.roles',compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'roleName'=>'required|alpha|max:20|unique:roles,name',
            'roleSlug'=>'required|alpha|max:20|unique:roles,slug'
        ]);
    
        $role=new role();
        $role->name=ucfirst($request->roleName);
        $role->slug=strtolower($request->roleSlug);
        $role->save();

        return redirect()->back();
    }

    public function delete(Request $request){
        $roleId=$request->roleId;
        $role=role::find($roleId);
        if($role->slug=='admin'){
            session::flash('deleteError','this role can not be deleted.');
            return redirect()->back();
        }
        else{

            $role->delete();
            return redirect()->back();
        }
    }
}

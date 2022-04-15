<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use Nette\Utils\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::paginate(10);
        return view('admin.users.allUsers',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        
        $user=auth()->user();
        return view('admin.users.profile',compact('user'));
    }


    public function showAny($id)
    {
        $user=User::find($id);
        return view('admin.users.profile',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $user=auth()->user();
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=auth()->user()->id;
        $user=User::find($id);
        $request->validate([
            'name'=>'required|alpha',
            'email'=>'required|email'
        ]);

        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();
        session::flash('userUpdateMessage','The user Profile is updated successfully.');
        return redirect()->route('user.me.profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session::flash('userDeleteMessage','The User has been deleted successfully.');

        return back();
    }

    // public function destroyMe()
    // {
    //     $id=auth()->user()->id;
    //     User::find($id)->delete();
    //     session::flash('userDeleteMessage','Your Profile has been deleted successfully.');

    //     return redirect()->route('/');
    // }


    public function assignRoles($userId){
        $user=User::find($userId);
        $userRoles=$user->roles;
        $totalRoles=role::all();
        return view('admin.users.assignRoles',compact('user','userRoles','totalRoles'));

        
    }

    public function updateRolesAttach(request $request,$userId){
        $user=User::find($userId);
      
        if($request['roles'] != null){

            foreach($request['roles'] as $roleId){
                $role= role::find($roleId);
                    $user->roles()->attach($role);
            }
        }
            return redirect()->back();
        
    }

    public function updateRolesDetach(request $request,$userId){
        $user=User::find($userId);
      
        if($request['detachRoles'] != null){

            foreach($request['detachRoles'] as $roleId){
                $role= role::find($roleId);
                    $user->roles()->detach($role);
            }
        }
            return redirect()->back();
        
    }
}

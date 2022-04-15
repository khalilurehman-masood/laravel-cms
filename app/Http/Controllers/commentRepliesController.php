<?php

namespace App\Http\Controllers;

use App\Models\commentReplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class commentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replies=commentReplies::paginate(15);
        return view('admin.commentReplies.index',compact('replies'));

    }

    public function myReplies(){
        $currentUserEmail=auth()->user()->email;
        $replies=commentReplies::where('email',$currentUserEmail)->paginate(15);
        return view('admin.commentReplies.index',compact('replies'));
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
        $request->validate([
            'commentId'=>'required',
            'reply'=>'required|max:1000'
        ]);

        $reply=new commentReplies();
        $reply->comment_id=$request->commentId;
        $reply->is_active='1';
        $reply->email=auth()->user()->email;
        $reply->author=auth()->user()->name;
        $reply->body=$request->reply;
        $reply->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'reply'=>'required',
            'replyId'=>'required'
        ]);
        $reply=commentReplies::findOrFail($request->replyId);
        $reply->body=$request->reply;
        $reply->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply=commentReplies::find($id);
        $reply->delete();
        Session::flash('replyDeleteMessage',"The reply is successfully deleted");
        return redirect()->back();
    }
}

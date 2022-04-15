<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\post;
use Illuminate\Http\Request;

class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments=comment::paginate(10);
        return view('admin.comments.index',compact('comments'));
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
    public function store(Request $request, $postId)
    {
        $request->validate([
            'author'=>'required|min:3|max:30',
            'email'=>'required|email',
            'body'=>'required|min:4'
        ]);

        $comment=new comment();
        $comment->author=$request->author;
        $comment->email=$request->email;
        $comment->body=$request->body;
        $comment->status='approved';
        $comment->post_id=$postId;
        
        $post=post::find($postId);
        $post->comments()->save($comment);

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $comment=comment::findOrFail($id);
      $comment->delete();
      return redirect()->back();
    }

    public function changeStatus($commentId){
        $comment=comment::find($commentId);
        if($comment->status=='approved'){
            $comment->status='unapproved';
            $comment->save();

        }
        else{
            $comment->status="approved";
            $comment->save();
        }

        return redirect()->back();
    }
}

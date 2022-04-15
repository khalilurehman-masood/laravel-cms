<?php
namespace App\Http\Controllers;

use App\Models\category;
use App\Models\post;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $posts=auth()->user()->posts()->paginate(3);

        return view('admin.posts.allPosts',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=category::all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $inputs=$request->validate([
            'title'=>'required|min:1|max:255',
            'post_image'=>'file',
            'body'=>'required|min:1|max:5000'
        ]);
        
        if($request->file('post_image')){
           $imageName=time().'_'.$request->file('post_image')->getClientOriginalName();
           $request->file("post_image")->move(public_path('images'),$imageName);


           $inputs['post_image']=$imageName;
        }
    
        $post=new post($inputs);
        $post->user_id=auth()->id();
        
        $post->save();

        if($request->categories != null){
            foreach($request->categories as $categoryId){
                $category=category::find($categoryId);
                $post->categories()->attach($category);
            }
        }

        session::flash('postCreateMessage','Post is created successfully.....!');
        return redirect()->route('posts.all');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $post=Post::where('slug',$slug)->get()->first();
        $comments=$post->comments->where('status','approved');
        $categories=category::all();
        return view('blog-post',compact('post','comments','categories'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
        //$this->authorize('update',$post);

        return view('admin.posts.edit',compact('post'));
       
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
        $post=post::find($id);
        $request->validate([
            'title'=>'required|min:1|max:255',
            'post_image'=>'file',
            'body'=>'required|min:1|max:1000'
        ]);
        if($request->file('post_image')){
            $imageName=time().'_'.$request->file('post_image')->getClientOriginalName();
            $request->file("post_image")->move(public_path('images'),$imageName);
            $post->post_image=$imageName;
         }
         $post->title=$request->title;
         $post->body=$request->body;
         $this->authorize('update',$post);
         $post->save();
         session::flash('postUpdateMessage','Post is updated successfully');
         return redirect()->route('posts.all');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
       
         $post_image=public_path('images\\').str_replace('http://127.0.0.1:8000/images/','',$post->post_image);
        
      
        if(Storage::exists($post_image)){

           unlink($post_image);
        }
        $post->delete();
        Session::flash('postDeleteMessage','Post was deleted successfully');
        return back();

    }

    public function allUsersPosts(){
        $posts=post::paginate(10);
        return view('admin.posts.allPosts',compact('posts'));
    }
}

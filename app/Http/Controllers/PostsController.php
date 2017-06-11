<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\Cost;

use Illuminate\Support\Facades\Storage;
 
class PostsController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }
    
    
    public function index()
    {
        $posts = Post::orderBy('created_at','DESC')->paginate(10);
        
        return view('posts.index', compact('posts'));
    }

   
    public function create()
    {
        return view('posts.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
			'title' => 'required',
			'body' => 'required',
			'cover_image'=>'image|nullable|max:1999',
			'donation' => 'required'
        ]);
        
        
        //handle file upload
        if($request->hasFile('cover_image'))
        {
			//Get file name with the extension
			$fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
			
			//Get just file name
			$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			
			//Get just ext
			$extension = $request->file('cover_image')->getClientOriginalExtension();
			
			//filename to store
			$fileNameToStore= $filename.'_'.time().'.'.$extension;
			
			//upload theimage
			$path= $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
			
			
		} else {
			$fileNameToStore='noimage.jpg';
		}
        
        
        $create_new_post= new Post;
        
        $create_new_post->title = $request->input('title');
        $create_new_post->body = $request->input('body');
        $create_new_post->user_id = auth()->user()->id;
        $create_new_post->cover_image = $fileNameToStore;
        $create_new_post->save();
        
        $late= Post::orderBy('created_at', 'desc')->first();
        
        $cost= new Cost;
        $cost->post_id = $late->id;
        $cost->price = $request->input('donation');
        $cost->save();
        
        return redirect('/posts')->with('success', 'Post created!');
    }


    public function show($id)
    {
        $show= Post::find($id);
		return view('posts.show', compact('show'));
    }

    
    public function edit($id)
    {
        $edit_post= Post::find($id);
        $edit_cost= Cost::where('post_id', $id)->first();
        
        if(auth()->user()->id !== $edit_post->user_id)
        {
			return redirect('/posts')->with('error','unauthorized access');
		}
        
		return view('posts.edit', compact('edit_post', 'edit_cost'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'title' => 'required',
			'body' => 'required',
			'donation' => 'required'
        ]);
        
        //handle file upload
        if($request->hasFile('cover_image'))
        {
			//Get file name with the extension
			$fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
			
			//Get just file name
			$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			
			//Get just ext
			$extension = $request->file('cover_image')->getClientOriginalExtension();
			
			//filename to store
			$fileNameToStore= $filename.'_'.time().'.'.$extension;
			
			//upload theimage
			$path= $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
			
			
		}
        
        $update_post = Post::find($id) ;
        
        $update_post->title = $request->input('title');
        $update_post->body = $request->input('body');
        if($request->hasFile('cover_image'))
        {
			$update_post->cover_image = $fileNameToStore;
		}
        $update_post->save();
        
        $update_cost = Cost::where('post_id', $id)->first();
        $update_cost->price= $request->input('donation');
        $update_cost->save();
        
        return redirect('/posts')->with('success', 'Post updated!');
    }

    
    public function destroy($id)
    {
        $delete_post = Post::find($id);
        //dd($delete_post);
        
        if(auth()->user()->id !== $delete_post->user_id)
        {
			return redirect('/posts')->with('error','unauthorized access');
		}
		
		if($delete_post->cover_image != 'noimage.jpg')
		{
			Storage::delete('public/cover_images/'.$delete_post->cover_image);
		}
        
        $delete_cost= Cost::where('post_id', $id)->delete();
        $delete_post->delete();
        
        return redirect('/posts')->with('success', 'Post deleted!');
    }
}

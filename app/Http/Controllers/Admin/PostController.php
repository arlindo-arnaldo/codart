<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;


class PostController extends Controller
{
    protected $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    
    public function savePost(Request $request){
        
        $request->validate([
            'title' => 'required',
        ],[
            'title.required' =>' Insira um titulo para o artigo'
        ]);

            $thumb_id = $request->thumb;
            
          //  $post = new Post();
            $this->post->title = $request->title;
            $this->post->body  = $request->body;
            $this->post->thumb = $thumb_id;
            $this->post->slug = Str::slug($request->title);

            if ($request->category_id == null && $request->subcategory_id == null) {
                $this->post->category_id = 1;
                $this->post->subcategory_id = null;

            }elseif ($request->category_id == null && $request->subcategory_id != null) {
                $this->post->category_id = null;
                $this->post->subcategory_id = $request->subcategory_id;
            }elseif ($request->category_id != null && $request->subcategory_id == null) {
                $this->post->category_id = $request->category_id;
                $this->post->subcategory_id = null;
            }else{
                $this->post->category_id = $request->category_id;
                $this->post->subcategory_id = $request->subcategory_id; 
            }
            
            $this->post->is_active = $request->post_status;
            $this->post->author_id = auth()->id();
            if($this->post->save()){
                $last_saved_post = Post::latest()->limit(1)->get();
                $id = $last_saved_post[0]['id'];
                $slug = $last_saved_post[0]['slug'];
                return redirect()->route('admin.posts.posts')->with('success', ['id' => $id,'msg' => 'Post adicionado com sucesso', 'slug' => $slug]);
                
            }else {
                session()->flash('fail', 'Ocorreu um erro ao tentar salvar o post');
                return redirect()->route('admin.posts.posts');
            }
        }
        
        
   

    public function deletePost($id){
        $post = Post::onlyTrashed()->where('id', $id)->first(); 
        if ($post) {
            if($post->forceDelete()){
                return redirect()->route('admin.posts.posts')->with('success', ['id' => $id, 'msg' => 'Artigo eliminidado permantentemente']);
            }
            
        } 
        return redirect()->route('admin.posts.posts')->with('fail', 'Ocorreu um erro ao tentar eliminar o artigo');     
        
    }

    public function restorePost($id){
      
        $post = Post::onlyTrashed()->where('id', $id)->first();       
        if($post->restore()){
          
            return redirect()->route('admin.posts.posts')->with('success', ['id' => $id, 'msg' => 'Artigo restaurado com sucesso']);
        }
        return redirect()->route('admin.posts.posts')->with('success', 'Ocorreu um erro ao tentar restaurar o artigo');
    }
    public function editPost($id){
        $post = Post::findOrFail($id);
        session()->flash('image', $post->thumbnail);
        
        return view('admin.pages.posts.edit-post', compact('post'));
        
    }
    public function updatePost($id, Request $request){
       
        $this->post->update([

        ]);
    }
    
}

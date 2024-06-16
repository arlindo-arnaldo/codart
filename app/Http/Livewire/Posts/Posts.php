<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class Posts extends Component
{
    use WithPagination;
    protected $posts = [];
    public $tab, $per_page = 5;
    
    public function mount()
    {
        
        $this->posts = Post::where('deleted_at', null)->orderBy('created_at', 'desc')->paginate(10);
        $this->tab = 'all';
        
    }

    public function filterPosts($filter)
    {
        switch ($filter) {
            case 0:
                $this->posts = Post::orderBy('created_at', 'desc')->paginate(10);
                $this->tab = 'all';
                break;
            case 1:
                $this->posts = Post::where('author_id', auth()->id())->orderBy('created_at', 'desc')->paginate(10);
                $this->tab = 'mine';
                break;

            case 2:
                $this->posts = Post::where('is_active', 1)->orderBy('created_at', 'desc')->paginate(10);
                $this->tab = 'published';
                break;

            case 3:
                $this->posts = Post::where('is_active', 0)->orderBy('created_at', 'desc')->paginate(10);
                $this->tab = 'draw';
                break;

            case 4:
                $this->tab = 'trash';
                $this->posts = [];
                $this->posts = Post::onlyTrashed()->paginate(10);
                break;
            default:
            $this->tab =  'all';
                $this->posts = [];
                $this->posts = Post::paginate(10);
        }
    }

    public function filterPostByCategory($cat_id){

        $this->posts = [];
        $this->posts = Post::where('category_id', $cat_id)->paginate(10); 
    }

    public function filterPostBySubCategory($subcat_id){
        $this->posts = [];
        $this->posts = Post::where('subcategory_id', $subcat_id)->paginate(10);
    }

    public function filterPostByUser($user_id){
        
        $this->posts = [];
        $this->posts = Post::where('author_id', $user_id)->paginate(10);
    }

    public function publishPost($id)
    {
        if ($post = Post::findOrFail($id)) {
            $post->update([
                'is_active' => 1
            ]);
            session()->flash('success', ['id' => $id, 'msg' => 'Post Publicado com sucesso']);
            $this->mount();
        }
    }

    public function deletePost($id)
    {
        if ($post = Post::findOrFail($id)) {
            if ($post->update(['is_active' => 0])) {
                if ($post->delete()) {
                    session()->flash('success', ['id' => null, 'msg'=>'Post Deletado com sucesso']);
                    $this->mount();
                }
            }
        }
    }

    public function render()
    { 
        $posts = $this->posts;
        return view('livewire.posts.posts', compact('posts'));
    }
}

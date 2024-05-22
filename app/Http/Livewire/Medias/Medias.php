<?php

namespace App\Http\Livewire\Medias;

use Livewire\Component;
use App\Models\File;

class Medias extends Component
{
    public $title, $path, $type, $description, $author, $created_at;

    public $file_type, $files = [];
    //protected $queryString = ['file_type'];
    
    public function mount(){
        $this->files = File::where('author_id', auth()->id())->get();
    }
    public function showMedia($media) {
        $this->title = $this->path = $this->type = $this->description = $this->author = $this->created_at = null;
        $this->title = $media['title'];
        $this->path = $media['path'];
        $this->type = $media['type'];
        $this->description = $media['description'];
        $this->author = $media['author_id'];
        $this->created_at = $media['created_at'];
        $this->dispatchBrowserEvent('showMediaModal',);
    }

    public function filterMedia(){
        #dd($this->file_type);
        if($this->file_type == "all"){
            $this->files = File::where('author_id', auth()->id())->get();
        }else {
            $this->files = File::where('type', $this->file_type)->where('author_id', auth()->id())->get();
        }
    }

    public function render()
    {
        
            /*if (!$this->file_type) {
               $medias = File::where('author_id', auth()->id())->get();
            }else{
                $medias = File::where('type', $this->file_type)->where('author_id', auth()->id())->get();
                $this->file_type = null; 
                
            }*/
            
            return view('livewire.medias.medias', ['medias' => $this->files]);
        
        
        
    }
}

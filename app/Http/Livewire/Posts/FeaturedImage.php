<?php

namespace App\Http\Livewire\Posts;

use App\Models\File;
use Livewire\Component;

class FeaturedImage extends Component
{
    public $photo;
    protected $listeners = [
        'refresh' => '$refresh',
        'selectImage' => 'selectImage'
    ];

    public function selectImage($image){
      $this->photo = $image;
    }
    public function unsetPhoto(){
        $this->photo = null;
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.posts.featured-image');
    }
}

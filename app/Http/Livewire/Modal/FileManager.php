<?php

namespace App\Http\Livewire\Modal;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FileManager extends Component
{
    protected $listeners = [
        'resetTabs' =>' resetTabs',
        'updateFileManager' => '$refresh',
        'updateFileManager' => 'resetTabs'
    ];
    public $selected_file = [];

    public function resetTabs(){
        $this->selected_file = null;
        $this->emit('updateUploadFile');
        $this->emit('');
    }
    public function mount() {
       
        
    }

    public function selectFile($media){
        $this->selected_file = $media;
        
        
    }
    public function selectImage(){
        if ($this->selected_file) {
            $this->emit('selectImage', $this->selected_file);
            //session()->flash('image_id', $this->selected_file['id']);
            $this->dispatchBrowserEvent('closeModal');
        }
    }
    public function deleteFile($id){
        $file = File::find($id);
        $path = $file->path;
        if ($file) {
            $delete = Storage::disk('public')->delete($path);
            $file->delete();
            if($delete){ 
                $file->delete();
                $this->emit('resetTabs');
                $this->emit('updateFileManager');
        }
           
        }
    }

    public function render()
    {
        
        $medias = File::where('type', 'image')->where('author_id', auth()->id())->get();
        return view('livewire.modal.file-manager', ['medias' => $medias]);
    }
}

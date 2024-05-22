<?php

namespace App\Http\Livewire\Modal;
use App\Models\File;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class UploadFile extends Component
{
    protected $listeners = [
        'updateUploadFile' => '$refresh',
    ];
    public function upload(Request $request){
        $file = $request->file('file');
        $filename = rand(0,10000).'_'.$file->getClientOriginalName();
        $size = $file->getsize();
        $path = 'app/public/';

        /* Cria um directorio de acordo o ano e o mês que o arquivo estiver sendo carregado*/

        $current_year = 'uploads/'.date('Y', strtotime(now()));
        $current_mounth = date('m', strtotime(now()));
        if (!Storage::disk('public')->exists($current_year)) {
           if(Storage::disk('public')->makeDirectory($current_year)){
                if (!Storage::disk('public')->exists($current_year.'/'.$current_mounth)) {
                    Storage::disk('public')->makeDirectory($current_year.'/'.$current_mounth);
                }
           } 
        }

        /* Se o upload for um sucesso, Salva as informações do ficheiro no banco de dados */

        if($file->move(storage_path($path.$current_year.'/'.$current_mounth), $filename)){
            $db_file = new File();
            $db_file->title = $filename;
            $db_file->path = $current_year.'/'.$current_mounth.'/'.$filename;

            if (in_array($file->getClientOriginalExtension(), ['jpg', 'png'])) {
                $type = 'image';
            }elseif(in_array($file->getClientOriginalExtension(), ['mp3', 'm4a'])){
                $type = 'audio';
            }elseif(in_array($file->getClientOriginalExtension(), ['mp4'])){
                $type = 'video';
            }elseif(in_array($file->getClientOriginalExtension(), ['pdf', 'txt'])) {
                $type = 'document';
            }else{
                return response()->json(['error', 'Não permitido']);  
            }

            $db_file->type = $type;
            $db_file->size = $size;
            $db_file->author_id = auth()->id();
            if ($db_file->save()) {
                $this->emit('updateFileManager');
                return response()->json(['success', $filename]);  
                
            }
        }     
    }
    public function render()
    {
        return view('livewire.modal.upload-file');
    }
}

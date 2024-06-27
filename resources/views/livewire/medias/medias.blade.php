<div class="p-20">
  
  <div class="card">       
    <div class="card-body">
      <form wire:submit.prevent="filterMedia">
        <div class="row">
          <div class="col-md-4">
            <select class="form-select" wire:model="file_type" wire:ignore.self>
              <option value="all">Todos os ficheiros multimédia</option>
                <option value="image">Imagens</option>
                <option value="video">Vídeos</option>
                <option value="document">Documento</option>
            </select>
          </div>  
          <div class="col-md-4">
              <button class="btn btn-outline-primary" wire:ignore.self>Filtrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row row-cards mt-1 ">
    @forelse ($medias as $media)
      <div class="col-6 col-lg-2 col-sm-4" wire:ignore.self>
        <div class="card" style="cursor: pointer;" wire:click="showMedia({{$media}})" wire:ignore.self>             
          <div class="img-responsive  card-img-top" style="background-image:
            @if($media->type == 'image')
              url('/storage/{{$media->path}}')"
            @endif
            @if($media->type == 'document')
              url('/admin-assets/static/icons/doc.png');
            @endif
            @if($media->type == 'audio')
              url('/admin-assets/static/icons/audio.png');
            @endif
            @if($media->type == 'video')
              url('/admin-assets/static/icons/video.png'); 
            @endif
                background-size:contain;"
                >    
            @if ($media->type != 'image')
              <span style="border-top:1px solid #ddd;position:absolute; bottom:0%;background-color:rgba(247, 247, 247, 0.945); width:100%; padding:3px 5px; text-align:center;font-size:12px;">
                <b> {{$media->title}} </b>
              </span>
            @endif
          </div>
        </div>
      </div>
    @empty
    <div class="alert alert-danger">
      Vazio  
    </div>      
    @endforelse        
  </div>


</div>


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

  <div wire:ignore.self class="modal modal-blur fade show" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-full-width modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detalhes do anexo</h5>
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row p-3">
            <div class="col-md-8 ">
              @if ($this->type == 'video')
                  <video src="/storage/{{$this->path}}" style="width: 90%" controls></video>
              @endif
              @if ($this->type == 'audio')
                  <audio src="/storage/{{$this->path}}" style="width: 90%" controls></audio>
              @endif
              @if ($this->type == 'image')
                  <img src="/storage/{{$this->path}}" alt="" style="width: 80%;"> 
              @endif
              @if ($this->type == 'document')
                  <h3>Documento</h3>

              @endif
              
            </div>
            <div class="col-md-4">
            <div class="bg-gray">
              Carregado aos : {{date('d-m-Y',strtotime($this->created_at))}}
            </div>
            <form action="">
              <div class="form-group">
                <span class="form-label">Titulo</span>
                <input type="text" wire:model="title" class="form-control">
              </div>
              <div class="form-group">
                <span class="form-label">Descrição</span>
                <textarea class="form-control" wire:model="description"></textarea>
              </div>
              <div class="form-group">
                <span class="form-label">Caminho</span>
                <input type="text" class="form-control" value="{{$_ENV['APP_URL']}}/storage/{{$this->path}}" readonly disabled>
              </div>
              <div class="form-group mt-2">
                <a wire:click="deleteFile()" class="text-danger" style="cursor: pointer">Excluir permanentemente</a>
              </div>
              <div class="form-group mt-5">
                <button class="btn btn-primary" {{!$description ?'disabled' : ''}}>Salvar alterações</button>
              </div>
            </form>
          </div>
          </div>
          
    </div>
  </div>
</div>   
</div>
</div>


<div>
    
    <dialog id="file_manager" wire:ignore.self> 
        <div class="header">
            <h2>Imagem de destaque</h2>
            <span id="btn-close" onclick="closeModal()">&times;</span>
        </div>
        <div class="body">
            <div class="content">
               
                      <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist" >
                        <li class="nav-item" role="presentation" >
                          <a href="#upload-file" class="nav-link " data-bs-toggle="tab" aria-selected="false" role="tab" style="border-radius: 0px;border-bottom:none;">Carregar Ficheiros</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a href="#file-explorer" class="nav-link active" data-bs-toggle="tab" aria-selected="true" tabindex="-1" role="tab" style="border-radius: 0px; border-bottom:none;">Biblioteca multimédia</a>
                        </li>
                        
                      </ul>
                    
                    
                      <div class="tab-content">
                        
                        <div class="tab-pane " id="upload-file" role="tabpanel">
                           
                          <br> <br><br> <br>
                          @livewire('modal.upload-file')
                          
                        </div>
                        <div class="tab-pane active show" id="file-explorer" role="tabpanel">
                          <br>
                          <div class="row">
                            <div class="col">
                              <select name="" id="" class="form-select">
                                <option value="" >Imagens</option>
                                <option value="">Meus</option>
                              </select>
                            </div>

                            <div class="col">
                              <select name="" id="" class="form-select">
                                <option value="" >Todas as datas</option>
                                <option value="">Abril 2024</option>
                              </select>
                            </div>
                            <div class="col"></div>
                           <div class="col col-md-1" >
                            <a href="#" class="text-muted" id="updateFileManager"  rel="noopener"  data-bs-toggle="tooltip" data-bs-placement="top" aria-label="refresh" data-bs-original-title="refresh">
                              <!-- Download SVG icon from http://tabler-icons.io/i/refresh -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path></svg>
                            </a>
                           </div>
                            <div class="col">
                              <input type="text" class="form-control" placeholder="Pesquisar">
                            </div>
                          </div>
                          
                          <!---->
                          <div class="row row-cards mt-1 ">
                            @forelse ($medias as $media)
                              <div class="col-md-6 col-lg-2 col-sm-2" wire:ignore.self>
                                <div class="card" style="cursor: pointer;" wire:click="selectFile({{$media}})">             
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
                          <!---->
                          <div>
                          </div>
                        </div>
                      </div>
                  </div>
            
            <div class="details">
                @if ($selected_file)
                <span class="text-muted">DETALHES DO ANEXO</span> 
                @if (session('image_id'))
                    {{session('image_id')}}
                @endif
                <br> <br>
                <div>
                  <img src="/storage/{{$selected_file['path']}}" alt="" id="thumb_viewer">
                </div>
                <span class="text-bold">{{$selected_file['title']}}</span> <br>
                <span class="text-muted">
                    {{date('d', strtotime($selected_file['created_at']))}} de  {{date('F, Y', strtotime($selected_file['created_at']))}}
                </span> <br>
                <span class="text-muted">
                  @if ($selected_file['size'] / 1024 < 1000)
                   {{round($selected_file['size']/1024)}} KB <br>
                  @else
                  {{round($selected_file['size']/(1024*1024))}} MB <br>
                  @endif
                   
                </span>
                
                <span ><a  href="#" class="text-danger" wire:click="deleteFile({{$selected_file['id']}})">Eliminar Permanentemente</a></span>
                <br>

                
                  <br>
                  <div class="form-group">
                    <span class=" text-muted">Descrição</span>
                    <textarea  class="form-control" rows="5"> {{$selected_file['description']}}</textarea>
                  </div> <br>
                  <div class="form-group">
                    <span class=" text-muted">URL do ficheiro</span>
                    <input type="text" id="path" class="form-control disabled" value="http:://localhost:8000/storage/{{$selected_file['path']}}" readonly  >
                  </div> <br>
                  <div class="form-group">
                    <a class="btn btn-outline-primary"  id="copyPath" onclick="copyPath()">Copiar URL </a>
                    <span class="text-success d-none" id="feedback">Copiado!</span>
                  </div>
                @endif
               
            </div>

        </div>
        <div class="footer">
            <a class="btn btn-outline-primary active {{!$selected_file ? 'disabled' : ''}}"
              
              wire:click="selectImage()"
              
            >Definir imagem de destaque</a> 
            
        </div>
    </dialog>

</div>

<div>
  @php
  $all = \App\Models\Post::all()->count();
  $mine = auth()->user()->posts->count(); 
  $draw = \App\Models\Post::where('is_active', 0)->count();
  $published = \App\Models\Post::where('is_active', 1)->count();
  $trash = \App\Models\Post::onlyTrashed()->count();
@endphp

<div class="row">
  <div class="col-md-7"></div>
  <div class="col-md-5">
    
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fadeIn" style="color: rgb(58, 58, 58);">
     
     @php
      $last_modified = session('success')['id']
      @endphp

       {{session('success')['msg']}}  .

      @if (!empty(session('success')['slug']))
          <b> <a target="blank" class="text-link" href="/{{session('success')['slug']}}">ver artigo</a></b>
      @endif
      <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if (session('fail'))
    <div class="alert alert-danger alert-dismissible" style="color: rgb(58, 58, 58);">
      {{session('fail')}}
      <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
  </div>
</div>
<div>
    <ul id="filter-posts">
        <li wire:click="filterPosts(0)" style="{{$tab == 'all' ? 'font-weight:500;' : ''}}"> Tudo <span class="text-muted ml-2">({{$all}}) | </span></li>
        <li  wire:click="filterPosts(1)" style="{{$tab == 'mine' ? 'font-weight:500;' : ''}}"> Meu <span class="text-muted">({{$mine}}) | </span></li>
        <li wire:click="filterPosts(2)" style="{{$tab == 'published' ? 'font-weight:500;' : ''}}">Publicado<span class="text-muted">({{$published}}) |</span></li>
        <li wire:click="filterPosts(3)" style="{{$tab == 'draw' ? 'font-weight:500;' : ''}}">Rascunho <span class="text-muted">({{$draw}}) </span></li>
        @if ($trash > 0)
          | <li wire:click="filterPosts(4)" style="{{$tab == 'trash' ? 'font-weight:500;' : ''}}"> Lixeira <span class="text-danger">({{$trash}})</span></li>  
        @endif
        
    </ul>
</div>
<div class="card mt-1">
    <div class="table-responsive">
      <table class="table table-vcenter table-mobile-md card-table">
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Categorias</th>
            <th>Comentários</th>
            <th>Data</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($posts as $post)
           
             <tr>
          <td data-label="Nome de utilizador" 
              @if (session('success'))
              @if ($post->id == $last_modified) style="border-left: 5px solid rgb(33, 103, 0)" @endif
              @endif
          >
            
            <div class="d-flex py-1 align-items-center">
              <span class="avatar me-2" style="background-image: url(/storage/{{$post->thumbnail->path}})"></span>
              <div class="flex-fill">
                <div class="font-weight-medium">
                  <a href="/{{$post->slug}}" class="text-reset" style="text-decoration: none;">{{$post->title}}</a>
                  
                </div>
              </div>
            </div>
          </td>
          <td data-label="Nome">
            <a   wire:click="filterPostByUser({{$post->author->id}})" style="cursor: pointer">
              {{explode(' ', $post->author->name)[0]}}
            </a>
          </td>
          <td class="text-muted" data-label="Email">
            @if ($post->category_id != null && $post->subcategory_id == null)
              <a  class="text-reset" wire:click="filterPostByCategory({{$post->category_id}})" style="cursor: pointer">
                {{$post->category->name}}
              </a> 
            @elseif($post->subcategory_id != null && $post->category_id == null)
             <!--/categories/{{$post->subcategory->parentCategory->slug}}/{{$post->subcategory->slug}} -->

            <a  class="text-reset" wire:click="filterPostBySubCategory({{$post->subcategory_id}})" style="cursor: pointer">
              {{$post->subcategory->name}}
            </a>
            @else
            <a  class="text-reset" wire:click="filterPostByCategory({{$post->category_id}})" style="cursor: pointer">
              {{$post->category->name}}
            </a> ,

            <a  class="text-reset" wire:click="filterPostBySubCategory({{$post->subcategory_id}})" style="cursor: pointer">
              {{$post->subcategory->name}}
            </a>
            @endif
            
            
          </td>
          <td class="text-muted" data-label="Papel">
              0
            </td>
            
              <td class="text-muted" data-label="Posts">
                @if (!$post->trashed())
                {{$post->is_active ? 'Publicado' : 'Rascunho'}} <br> {{date('d-m-Y', strtotime($post->created_at))}} ás {{date('h:i', strtotime($post->created_at))}}
                @else
                  Última modificação <br> {{date('d-m-Y', strtotime($post->created_at))}} ás {{date('h:i', strtotime($post->updated_at))}}
                @endif
              </td>
            
            
          <td>
              <div class="drop">
                  <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                  </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                  @if (!$post->trashed())
                    @if (!$post->is_active && ($post->author_id == auth()->id() || auth()->user()->type == 1))
                      <a class="dropdown-item  active" href="#" wire:click="publishPost({{$post->id}})">
                        Publicar
                      </a>
                    @endif

                    <a class="dropdown-item" href="#">
                      ver
                    </a>
                  @endif
                  
                  
                  @if ($post->author_id == auth()->id() || auth()->user()->type == 1)
                    @if (!$post->trashed())
                      <a class="dropdown-item" href="{{route('admin.posts.edit-post', $post->id)}}">
                        Editar
                      </a>
                    @endif
                    

                    @if ($post->trashed())
                    
                      <a class="dropdown-item" onclick="event.preventDefault();document.querySelector('#restore-post-{{$post->id}}').submit()">
                        Restaurar
                      </a>

                      <form action="{{route('admin.posts.restore-post', $post->id)}}" method="post" id="restore-post-{{$post->id}}">
                        @csrf
                        
                      </form>

                      <a class="dropdown-item" onclick="event.preventDefault();document.querySelector('#delete-post-{{$post->id}}').submit()">
                        <span class="text-danger">Eliminar permanentemente</span>
                      </a>

                      <form action="{{route('admin.posts.delete-post', $post->id)}}" method="post" id="delete-post-{{$post->id}}">
                        @csrf
                      </form>

                    

                    @else
                      
                        <a class="dropdown-item" wire:click="deletePost({{$post->id}})">
                          <span class="text-danger">Eliminar</span>
                        </a>
                    @endif
                    
                  @else
                    @if ($post->author_id != auth()->id() && $post->trashed())
                    <a  class="dropdown-item">
                      Sem acoes
                    </a>
                  @endif
                  @endif
                  
                    
                </div>
              </div>
          </td>
      </tr> 
          @empty
              
              
          @endforelse
          
                         
        </tbody>
      </table>
        <div class="m-4">
          
        </div>
    </div>
  </div>
</div>
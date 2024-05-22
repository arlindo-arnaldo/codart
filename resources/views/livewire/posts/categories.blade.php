
<div>
    <div class="row row-cards">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4> {{$this->update_mode ? 'Actualizar categoria' : 'Adicionar categoria'}}</h4>
                </div>
                <form wire:submit.prevent=" {{$this->update_mode ? 'updateCategory()' : 'saveCategory()'}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Categoria superior</label>
                            <select class="form-select" wire:model="parent_id">
                                <option selected> ---Nehum-- </option>
                                @foreach ($categories as $category)
                                @if ($this->update_mode)
                                    @if ($category->id != $this->category_id && $category->id != 1)
                                        <option value="{{$category->id}}"> {{$category->name}}</option>
                                    @endif
                                @else
                                    @if ($category->id != 1)
                                        <option value="{{$category->id}}"> {{$category->name}}</option>    
                                    @endif 
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Descrição</label>
                            <textarea rows="6" class="form-control" wire:model="description"> </textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">{{$this->update_mode ? 'Actualizar categoria' : 'Adicionar nova categoria'}}</button>
                        @if ($update_mode)
                                <a class="btn btn-secondary" wire:click="ResetAll()">
                                    Anular
                                </a>
                        @endif
                    </div>
                </form>
                
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4>Todas as categorias</h4>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-vcenter card-table">
                          <thead>
                            <tr>
                              <th>Nome</th>
                              <th>Slug</th>
                              <th>Posts</th>
                              <th class="w-1"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($categories as $category)
                            <tr>
                              <td>
                                
                                {{$category->name}}</td>
                              <td class="text-muted">
                                <a target="blank" href="/categories/{{$category->slug}}" class="text-reset">
                                    {{$category->slug}}
                                </a>
                              </td>
                              <td class="text-muted">
                                    {{$category->posts->count()}}
                              </td>
                              
                              
                              <td>
                                <div class="drop">
                                    <a href="#" class="btn-action dropdown-toggle show" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                                    </a>
                                    
                                    <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 34px);">
                                        <a class="dropdown-item" href="#">Ver</a>
                                        @if ($category->id != 1)
                                         <a class="dropdown-item" wire:click="editCategory({{$category}})">Editar</a>
                                         <a class="dropdown-item text-danger" wire:click="deleteCategory({{$category->id}})">Deletar</a>
                                         @endif
                                    </div>
                                  </div>
                              </td>
                            </tr>
                            @foreach($category->child as $subcategory)
                                <tr>
                                    <td style="text-indent: 15px;">
                                        
                                       -- {{$subcategory->name}}
                                    </td>

                                  <td class="text-muted">
                                    <a target="blank" href="/categories/{{$category->slug}}/{{$subcategory->slug}}" class="text-reset">
                                        {{$subcategory->slug}}
                                    </a>
                                  </td>
                                  <td class="text-muted">
                                        {{$subcategory->posts->count()}}
                                  </td>
                                  
                                  
                                  <td>
                                    <div class="drop">
                                        <a href="#" class="btn-action dropdown-toggle show" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                                        </a>
                                        
                                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 34px);">
                                            <a class="dropdown-item" href="#">Ver</a>
                                            @if ($category->id != 1)
                                             <a class="dropdown-item" wire:click="editSubCategory({{$subcategory}})">Editar</a>
                                             <a class="dropdown-item text-danger" wire:click="deleteSubCategory({{$subcategory->id}})">Deletar</a>
                                             @endif
                                        </div>
                                      </div>
                                  </td>
                                </tr>
                            @endforeach
                            @empty
                                <td>
                                    <span class="text-danger">Vazio</span>
                                </td>
                            @endforelse
                          
                          </tbody>
                        </table>
                      </div>
                </div>

            </div>
        </div>
    </div>
    
</div>

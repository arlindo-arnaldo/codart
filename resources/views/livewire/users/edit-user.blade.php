<div>
  <div class="row">
    <div class="col-md-7"></div>
    <div class="col-md-5">
      @if (session('success'))
      <div class="alert alert-success alert-dismissible fadeIn" style="color: rgb(58, 58, 58);">
        {{session('success')}}
        <button class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      @endif
      </div>
    </div>
      <form class="card" wire:submit.prevent="save">
          <div class="card-header">
          </div>
          <div class="col-md-9">
              <div class="card-body">
                  <div class="mb-3 row">
                      <label class="col-3 col-form-label">Nome de utilizador</label>
                      <div class="col">
                        <input type="text" class="form-control" wire:model="username">
                          @error('username')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>
                    </div>
          
                <div class="mb-3 row">
                  <label class="col-3 col-form-label">Email</label>
                  <div class="col">
                    <input type="text" class="form-control" wire:model="email">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                  </div>
                </div>
          
                <div class="mb-3 row">
                  <label class="col-3 col-form-label">Nome</label>
                  <div class="col">
                    <input type="text" class="form-control" wire:model="name">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                  </div>
                </div>
          
                
                <div class="mb-3 row">
                  <label class="col-3 col-form-label">Papel</label>
                  <div class="col">
                    <select class="form-select" wire:model="type"> 
                      <option value="">--- não selecionado --</option>
                      @foreach (\App\Models\Type::all() as $type)
                      <option value="{{$type->id}}">{{$type->name}}</option>    
                      @endforeach
                    </select>
                    @error('type')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                  </div>
                </div>
                
              </div>
              
          </div>
          <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">Salvar alterações</button>
            </div>
      </form>
  </div>
  
<div>
  @if (session('success'))
  <div class="alert alert-success alert-dismissible">
    {{session('success')}}
    <button class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif
    <form class="card" wire:submit.prevent="save">
        <div class="card-header">
        </div>
        <div class="col-md-9">
            <div class="card-body">
                <div style="text-align: center;margin-left:25%;" class="mb-3">
                  <a href="#" class="avatar avatar-upload rounded" onclick="
                    event.preventDefault();
                    document.querySelector('#photo').click();
                    ">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <div wire:loading wire:target="photo" style="text-align: center;">
                      <span class="input-icon-addon">
                        <div class="spinner-border spinner-border-sm text-muted" role="status"></div>
                      </span>
                    </div>
                    @if ($photo)
                        <img src="{{$photo->temporaryUrl()}}" alt="">
                      @else
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                      <span class="avatar-upload-text">Add</span>
                    @endif

                    @error('photo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    
                    
                  </a>
                </div>
                <input type="file" class="d-none" id="photo" wire:model="photo">

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
                <label class="col-3 col-form-label">Password</label>
                <div class="col">
                    <a wire:click.prevent="generatePassword" href="#" class="btn mb-2">Gerar senha</a>
                  <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model="password" >
                    <span class="input-group-text">
                      <a class="link-secondary" id="show-password" title="Mostrar senha" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg"  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                      </a>
                      <a class="link-secondary" title="Ocultar" data-bs-toggle="tooltip" id ="hide-password">
                      <svg xmlns="http://www.w3.org/2000/svg"   class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"></path><path d="M3 3l18 18"></path></svg>
                      </a>
                    </span>
                    
                    
                  </div>
                    
                  @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                       
                  <small class="form-hint">
                    Sua senha deve ter 8-20 caractetes, contendo letras e números, e não deve conter espaços, caracteres especiais, ou emojis.
                  </small>
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
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
    </form>
</div>

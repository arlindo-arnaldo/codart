<div>
  @if (session('success'))
            <div class="alert alert-success alert-dismissible" >
              {{session('success')}}
              <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif 
    <form wire:submit.prevent="UpdatePersonalDetails">
        <div class="card-body">
          <h3 class="card-title">Editar Perfil</h3>
          <div class="row row-cards">
            <div class="col-md-5">
              <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control"  placeholder="Seu nome Completo" wire:model="name">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="mb-3">
                <label class="form-label">Nome de usuário</label>
                <input type="text" class="form-control" placeholder="Nome de usuário" wire:model="username">
                    @error('username')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Email" wire:model="email">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
              </div>
            </div>
            
           
            <div class="col-md-12">
              <div class="mb-3 mb-0">
                <label class="form-label">Sobre mim</label>
                <textarea rows="5" class="form-control" placeholder="Aqui você pode falar um pouco sobre você" value="Mike" wire:model="about"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary">Actualizar perfil</button>
        </div>
      </form>
</div>

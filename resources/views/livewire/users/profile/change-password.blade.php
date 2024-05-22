<div>
  @if (session('success'))
            <div class="alert alert-success alert-dismissible">
              {{session('success')}}
              <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif 
    <form wire:submit.prevent="changePassword()">
        <div class="card-body">
          <h3 class="card-title">Editar palavra passe</h3>
          <div class="row row-cards">
            <div class="col-md-5">
              <div class="mb-3">
                <label class="form-label">Senha actual</label>
                <input type="text" class="form-control" wire:model="current_password">
                  @error('current_password')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="mb-3">
                <label class="form-label">Nova Senha</label>
                <input type="text" class="form-control" wire:model="new_password">
                  @error('new_password')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="mb-3">
                <label class="form-label">Confirmar nova senha</label>
                <input type="text" class="form-control" wire:model="confirm_password">
                  @error('confirm_password')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>
            </div>

          </div>
        </div>
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary">Actualizar senha</button>
        </div>
      </form>
</div>

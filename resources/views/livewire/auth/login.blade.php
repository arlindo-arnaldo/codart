<div>
    @if (session('info'))
      <div class="alert alert-info alert-dismissible fade show">
          <b>{{session('info')}}</b>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if (session('fail'))
        <div class="alert alert-danger alert-dismissible fade show">
            <b>{{session('fail')}}</b>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card card-md">
        <div class="card-body">
          <h2 class="h2 text-center mb-4">Entre com a sua conta</h2>
          <form wire:submit.prevent="loginHandler()" autocomplete="off" novalidate>
            <div class="mb-3">
              <label class="form-label">Endereço de e-mail</label>
              <input type="email" class="form-control" placeholder="seu@email.com" autocomplete="off" wire:model="email">
              @error('email')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="mb-2">
              <label class="form-label">
                Senha
                <span class="form-label-description">
                  <a href="{{route('admin.reset-password')}}">Não lembro a senha</a>
                </span>
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control"  placeholder="Sua Senha"  autocomplete="off" wire:model="password">
                
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                  </a>
                </span>
              </div>
              @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-2">
              <label class="form-check">
                <input type="checkbox" class="form-check-input" wire:model="remember"/>
                <span class="form-check-label">Mantem-me conectado neste dispositivo</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </div>
          </form>
        </div>
    </div>
</div>

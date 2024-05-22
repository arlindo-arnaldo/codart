<div>
  @if (session('success'))
  <div class="alert alert-success alert-dismissible">
    {{session('success')}}
    <button class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

        <div class="card">
          <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table">
              <thead>
                <tr>
                  <th>Nome de utilizador</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Papel</th>
                  <th>Posts</th>
                  <th class="w-1"></th>
                </tr>
              </thead>
              <tbody>
               @forelse ($users as $user)
               <tr>
                <td data-label="Nome de utilizador">
                  <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url(/storage/users/{{$user->photo}})"></span>
                    <div class="flex-fill">
                      <div class="font-weight-medium">{{$user->username}}</div>
                    </div>
                  </div>
                </td>
                <td data-label="Nome">
                  <div>{{$user->name}}</div>
                </td>
                <td class="text-muted" data-label="Email">
                  {{$user->email}}
                </td>
                <td class="text-muted" data-label="Papel">
                    {{$user->userType->name}}
                  </td>
                  <td class="text-muted" data-label="Posts">
                    0
                  </td>
                <td>
                    <div class="drop">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                        </a>
                      <div class="dropdown-menu dropdown-menu-end" style="">
                        <a class="dropdown-item" href="#">
                          ver
                        </a>
                        <a class="dropdown-item" href="{{route('admin.users.edit-user', $user->id)}}">
                          Editar
                        </a>
                        @if ($user->id != auth()->id())
                          <a class="dropdown-item text-danger" href="#" wire:click.prevent="deleteUser({{$user->id}})">
                            Excluir
                          </a>
                        @endif  
                      </div>
                    </div>
                </td>
            </tr>
               @empty
                   <tr>
                    <span class="text-danger">Nenhum usuário</span>
                   </tr>
               @endforelse
                
              </tbody>
            </table>
             <div class="m-4">
              {{$users->links('livewire::bootstrap')}}
             </div>
          </div>
      </div>   
</div>

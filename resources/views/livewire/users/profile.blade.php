<div>
    <div class="page-header">
        <div class="container">

          @if (session('success'))
            <div class="alert alert-success alert-dismissible">
              {{session('success')}}
              <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <div class="row align-items-center">
            <div class="col-auto">
              <span class="avatar avatar-lg rounded" style="background-image: url(/storage/users/{{$user->photo}})"></span>
            </div>
            <div class="col">
              <h1 class="fw-bold">{{$user->name}}</h1>
              <div class="my-2">{{$user->email}}
              </div>
              <div class="list-inline list-inline-dots text-muted">
                <div class="list-inline-item">
                 {{$user->username}}
                </div>
              </div>
            </div>

             

            <div class="col-auto ms-auto">
              <input type="file" id="picture" name="file" class="d-none" onchange="this.dispatchEvent(new InputEvent('input'));">
              <div class="btn-list"> 
                <a class="btn btn-primary" onclick="

                  event.preventDefault();
                  document.querySelector('#picture').click();
                  ">
                  <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path><path d="M9 13a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path></svg>
                  Alterar foto
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      

      <div class="col-md-12 mt-5">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                  Informações Pessoais</a>
              </li>
              <li class="nav-item" role="presentation">
                <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab" aria-selected="true" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                  Alterar Senha</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active show" id="tabs-home-3" role="tabpanel">
                
                <div>
                    @livewire('users.profile.personal-details')
                </div>
              </div>


              <div class="tab-pane " id="tabs-profile-3" role="tabpanel">
              
                <div>
                    @livewire('users.profile.change-password')                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

@extends('admin.layouts.auth')
@section('title', 'login')
@section('content')

<form class="card card-md" action="./" method="get" autocomplete="off" novalidate>
    <div class="card-body">
      <h2 class="card-title text-center mb-4">Forgot password</h2>
      <p class="text-muted mb-4">Enter your email address and your password will be reset and emailed to you.</p>
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" placeholder="Enter email">
      </div>
      <div class="form-footer">
        <a href="#" class="btn btn-primary w-100">
          <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
          Enviar uma nova senha
        </a>
      </div>
    </div>
  </form>

@endsection
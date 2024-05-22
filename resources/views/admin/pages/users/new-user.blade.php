@extends('admin.layouts.pages')
@section('title','Adicionar novo utilizador')

@section('page-title','Adicionar novo utilizador')
@section('content')  
    @livewire('users.new-user')
@endsection

@push('scripts')
    <script>
        $('#show-password').click( function(){
            event.preventDefault();
            alert('Mostrar');
        });
    </script>
@endpush
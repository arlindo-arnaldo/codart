@extends('admin.layouts.pages')
@section('title','Utilizadores')
@section('page-pretitle', 'Overview')
@section('page-title','Utilizadores ')

@section('top-button')
  <a href="{{route('admin.users.create-user')}}" class="btn mr-2">
      Adicionar novo utilizador
    </a>
@endsection

@section('content')
  @livewire('users.users')
@endsection


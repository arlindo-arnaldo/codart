@push('styles')
  <style>
    ul#filter-posts{
      
      list-style-type: none;
    }
    ul#filter-posts li{
      display: inline-block;
      margin-right: 10px;
      cursor: pointer;
    }
    ul#filter-posts li:hover{
      color: rgb(46, 100, 139)
    }
    ul#filter-posts li span#filter-text{
      color: rgba(9, 9, 173, 0.725);
      
    }
  </style>
  
@endpush

@extends('admin.layouts.pages')
@section('title','Artigos')
@section('page-pretitle','Visão geral')
@section('page-title','Artigos')


@section('top-button')
<a href="{{route('admin.posts.new-post')}}" class="btn mr-2">
    Adicionar novo artigo 
  </a>
@endsection

@section('content')
    @livewire('posts.posts')

@endsection


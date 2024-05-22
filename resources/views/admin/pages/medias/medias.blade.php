@extends('admin.layouts.pages')
@section('title','Biblioteca de multimédias')
@section('page-pretitle','Overview')
@section('page-title','Biblioteca de multimédias')

@section('top-button')
  <a href="{{route('admin.medias.new-media')}}" class="btn mr-2">
    Adicionar novo ficheiro multimédia
  </a>
@endsection

@section('content')
    
  @livewire('medias.medias')

@endsection

@push('scripts')
   <script>
    
    window.addEventListener('showMediaModal', function(){
      $('#modal-large').modal('show');
    });
   </script>
@endpush
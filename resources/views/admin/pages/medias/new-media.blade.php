@extends('admin.layouts.pages')
@section('title','Carregar multimedia')

@section('page-title','Carregar multimédia')
@section('content')
    
<div class="card" style="border-radius: 0%">
    <div class="card-body">
      <h3 class="card-title"></h3>
      <form  method="POST" action="{{route('admin.medias.upload-media')}}" class="dropzone dz-clickable" id="dropzone-default"  autocomplete="off" novalidate="" enctype="multipart/form-data">
        @csrf
      <div class="dz-default dz-message">
        <button class="dz-button" type="button"> Largue os ficheiro  para carregar</button>
    </div>
    
    
    </form>

    </div>
  </div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
      new Dropzone("#dropzone-default")
    })
  </script>
@endpush
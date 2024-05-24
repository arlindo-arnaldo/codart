@extends('admin.layouts.pages')
@section('title','Adicionar novo artigo')

@section('page-title','Adicionar novo artigo')
@section('content')

@include('admin.includes.modal')
    @if (session('image'))
        @php
            session()->forget('image')
        @endphp
    @endif
    <form action="{{route('admin.posts.save-post')}}" method="POST" class="cards-row" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        
                        <input type="text" placeholder="Titulo do post" class="form-control" style="font-size: 18px;font-family:consolas;" name="title">
                        
                        @error('title')
                             <span class="text-danger">{{$message}}</span>
                        @enderror
                       
                    </div>
                    <div class="form-group mt-2">
                        <!--<textarea id="tinymce-mytextarea">Hello, <b>Tabler</b>!</textarea> -->
                    </div>
                    <textarea id="editor" name="body">
                        
                    </textarea>
                </div>
                <div class="col-md-4">
                    <div class="card" style="border-radius: 0%">
                        
                        <div class="card-body">
                           <div class="row">
                            <div class="col-md-8">
                                <select name="post_status" id="" class="form-select">
                                    <option value="1" selected>Publicar imediatamente</option>
                                    <option value="0">Guardar para revisão</option>
                                </select>
                               </div>
                                <div class="col-md-4">
                                    <button class="btn btn-md btn-primary">Publicar</button>
                                </div>
                           </div>
                            
                        </div>
                    </div>

                    <div class="card mt-1 " style="border-radius: 0%">
                        
                        <div class="card-body">
                           <h4>Categorias</h4>
                            @foreach (\App\Models\Category::with('child')->latest()->get() as $category)
                            <label class="form-check">
                                <input class="form-check-input" type="radio" value="{{$category->id}}" name="category_id">
                                <span class="form-check-label">{{$category->name}}</span>
                              </label>
                                @foreach ($category->child as $subcategory)
                                <label class="form-check" style="margin-left: 10px;">
                                    <input class="form-check-input" type="radio" value="{{$subcategory->id}}" name="subcategory_id">
                                    <span class="form-check-label">{{$subcategory->name}}</span>
                                  </label>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    <div class="card mt-1 " style="border-radius: 0%">
                        @livewire('posts.featured-image')
                        
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			//toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>
@endpush
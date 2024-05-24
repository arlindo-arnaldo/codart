@extends('admin.layouts.pages')
@section('title','Editar artigo')

@section('page-title','Editar artigo')


@section('content')
@include('admin.includes.modal')




<form action="{{route('admin.posts.update-post', $post->id)}}" method="POST" class="cards-row" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    
                    <input type="text" placeholder="Titulo do post" class="form-control" style="font-size: 18px;font-family:consolas;" name="title" value="{{$post->title}}">
                    
                    @error('title')
                         <span class="text-danger">{{$message}}</span>
                    @enderror
                   
                </div>
                <div class="form-group mt-2">
                    <!--<textarea id="tinymce-mytextarea">Hello, <b>Tabler</b>!</textarea> -->
                </div>
                <textarea id="editor" name="body">
                    {{$post->body}}
                </textarea>
            </div>
            <div class="col-md-4">
                <div class="card" style="border-radius: 0%">
                    
                    <div class="card-body">
                       <div class="row">
                        <div class="col-md-8">
                            <select name="post_status" id="" class="form-select">
                                <option value="1" {{$post->is_active == 1 ? 'selected' : ''}}>Publicar imediatamente</option>
                                <option value="0" {{$post->is_active == 0 ? 'selected' : ''}}>Guardar para revisão</option>
                            </select>
                           </div>
                            <div class="col-md-4">
                                <button class="btn btn-md btn-primary">Actualizar</button>
                            </div>
                       </div>
                        
                    </div>
                </div>

                <div class="card mt-1 " style="border-radius: 0%">
                    
                    <div class="card-body">
                       <h4>Categorias</h4>
                        @foreach (\App\Models\Category::with('child')->latest()->get() as $category)
                        <label class="form-check">
                            <input class="form-check-input" type="radio" value="{{$category->id}}" name="category_id" {{$post->category_id == $category->id ? 'checked' : ''}}>
                            <span class="form-check-label">{{$category->name}}</span>
                          </label>
                            @foreach ($category->child as $subcategory)
                            <label class="form-check" style="margin-left: 10px;">
                                <input class="form-check-input" type="radio" value="{{$subcategory->id}}" name="subcategory_id" {{$post->subcategory_id == $subcategory->id ? 'checked' : ''}}>
                                <span class="form-check-label">{{$subcategory->name}}</span>
                              </label>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <div class="card mt-1 " style="border-radius: 0%">
                    
                    <div class="card-body">
                       
                       <!-- <div style="text-align: center" class="mb-3">
                        @if (!$post->thumb)
                            <a class="avatar avatar-upload rounded" onclick="
                                event.preventDefault();
                                document.querySelector('#photo').click();
                            ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                <span class="avatar-upload-text">Add</span>
                            </a>
                        @else
                        <img src="/storage/{{$post->thumbnail->path}}" alt="" onclick=" document.querySelector('#photo').click();" id="tumb_view">
                        @endif
                        
                        <input type="file" name="thumb" id="photo" class="d-none">
                      </div>-->

                      @livewire('posts.featured-image')

                      @error('thumb')
                      <span class="text-danger">{{$message}}</span>
                 @enderror
                    </div>
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


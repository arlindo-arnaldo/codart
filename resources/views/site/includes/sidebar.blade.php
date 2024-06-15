<div class="col-lg-4">
    <div class="widget-blocks">
      <div class="row">
        <div class="col-lg-12">
          <div class="widget">
            @if ($data)
            <div class="widget-body">
              @if ($type === 'post')
              <img loading="lazy" decoding="async" src="/storage/users/{{$data->author->photo}}" alt="About Me" class="w-100 author-thumb-sm d-block">
              <h2 class="widget-title my-3">{{$data->author->name}}</h2>
              <p class="mb-3 pb-2">{{$data->author->about}} …</p> <a href="#" class="btn btn-sm btn-outline-primary">Saber Mais</a>
              @endif
              @if ($type === 'category') 
              <h2 class="widget-title my-3">{{$data->name}}</h2>
              <p class="mb-3 pb-2">{{$data->description}} …</p> <a href="#" class="btn btn-sm btn-outline-primary">Saber Mais</a>
              @endif
            
            
          </div>
            @endif
          </div>
        </div>
        @if (recommendedPosts())
        <div class="col-lg-12 col-md-6">
          <div class="widget">
            <h2 class="section-title mb-3">Recomendados</h2>
            <div class="widget-body">
              <div class="widget-list">

                @foreach (recommendedPost() as $post)
                <article class="card mb-4">
                  <div class="card-image">
                    <div class="post-info"> <span class="text-uppercase">{{readDuration($post->title, $post->body)}} @choice('min|mins', readDuration($post->title, $post->body)) de leitura</span>
                    </div>
                    <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100">
                  </div>
                  <div class="card-body px-0 pb-1">
                    <h3><a class="post-title post-title-sm"
                        href="{{$post->slug}}">{{$post->title}} </a></h3>
                    <p class="card-text">{{summarize($post->body, 7)}}</p>
                    <div class="content"> <a class="read-more-btn" href="{{$post->slug}}">Ler Mais</a>
                    </div>
                  </div>
                </article>
                @endforeach

                @foreach (recommendedPosts() as $post)
                <a class="media align-items-center" href="{{route('post.show', $post->slug)}}">
                  <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100">
                  <div class="media-body ml-3">
                    <h3 style="margin-top:-5px">{{$post->title}}</h3>
                    <p class="mb-0 small">{{Str::ucfirst(Str::words(strip_tags($post->body), 10, '...'))}}</p>
                  </div>
                </a>
                @endforeach

              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="col-lg-12 col-md-6">
          <div class="widget">
            <h2 class="section-title mb-3">Categorias</h2>
            <div class="widget-body">
              <ul class="widget-list">
                @foreach (\App\Models\Category::with('child')->get() as $category)
                @if ($category->posts->count())
                    <li><a href="{{route('category.show', $category->slug)}}">{{$category->name}}<span class="ml-auto">  ({{$category->posts->count()}})</span></a>
                @endif
                  @foreach ($category->child as $subcategory)
                      @if ($subcategory->posts->count())
                      <li><a href="{{route('category.show', $subcategory->slug)}}">{{$subcategory->name}}<span class="ml-auto">({{$subcategory->posts->count()}})</span></a>
                      @endif
                  @endforeach

                </li>
                @endforeach

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
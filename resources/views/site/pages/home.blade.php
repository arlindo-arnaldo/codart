@extends('site.layouts.pages')
@section('title', 'home')
@section('content')
<section class="section">
    <div class="container">
      <div class="row no-gutters-lg">
        <div class="col-12">
          <h2 class="section-title">Últimos artigos</h2>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="row">
            <div class="col-12 mb-4">
              <article class="card article-card">
                <a href="article.html">
                  <div class="card-image">
                    <div class="post-info"> <span class="text-uppercase">{{date('d M Y', strtotime($latest_post->created_at))}}</span>
                      <span class="text-uppercase">3 minutes read</span>
                    </div>
                    <img loading="lazy" decoding="async" src="/storage/{{$latest_post->thumbnail->path}}" alt="Post Thumbnail" class="w-100">
                  </div>
                </a>
                <div class="card-body px-0 pb-1">
                  <ul class="post-meta mb-2">
                     <li>
                      <a href="{{$latest_post->category->slug}}">{{$latest_post->category->name}}</a>
                      <a href="{{$latest_post->subcategory->slug}}">{{$latest_post->subcategory->name}}</a>
                    </li>
                  </ul>
                  <h2 class="h1"><a class="post-title" href="{{$latest_post->slug}}">{{$latest_post->title}}.</a></h2>
                  <p class="card-text">{{ $latest_post->body }}</p>
                  <div class="content"> <a class="read-more-btn" href="{{$latest_post->slug}}">Ler mais</a>
                  </div>
                </div>
              </article>
            </div>
            
              @foreach ($posts as $post)
              <div class="col-md-6 mb-4">
              <article class="card article-card article-card-sm h-100">
                <a href="article.html">
                  <div class="card-image">
                    <div class="post-info"> <span class="text-uppercase">{{date('d M Y', strtotime($post->created_at))}}</span>
                      <span class="text-uppercase">2 minutes read</span>
                    </div>
                    <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100">
                  </div>
                </a>
                <div class="card-body px-0 pb-0">
                  <ul class="post-meta mb-2">
                    <li> <a href="#!">travel</a>
                    </li>
                  </ul>
                  <h2><a class="post-title" href="{{$post->slug}}l">{{$post->title}}</a></h2>
                  <p class="card-text">{{Str::ucfirst(Str::words(strip_tags($post->body), 20, '...'))}}</p>
                  <div class="content"> <a class="read-more-btn" href="{{$post->slug}}">Ler Mais</a>
                  </div>
                </div>
              </article>
            </div>
              @endforeach
            
            
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <nav class="mt-4">
                    <!-- pagination -->
                    <nav class="mb-md-50">
                      <ul class="pagination justify-content-center">
                        <li class="page-item">
                          <a class="page-link" href="#!" aria-label="Pagination Arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                            </svg>
                          </a>
                        </li>
                        <li class="page-item active "> <a href="index.html" class="page-link">
                            1
                          </a>
                        </li>
                        <li class="page-item"> <a href="#!" class="page-link">
                            
                          </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="#!" aria-label="Pagination Arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                            </svg>
                          </a>
                        </li>
                      </ul>
                    </nav>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
  <div class="widget-blocks">
    <div class="row">
      <div class="col-lg-12">
        <div class="widget">
          <div class="widget-body">
            <img loading="lazy" decoding="async" src="images/author.jpg" alt="About Me" class="w-100 author-thumb-sm d-block">
            <h2 class="widget-title my-3">Hootan Safiyari</h2>
            <p class="mb-3 pb-2">Hello, I’m Hootan Safiyari. A Content writter, Developer and Story teller. Working as a Content writter at CoolTech Agency. Quam nihil …</p> <a href="about.html" class="btn btn-sm btn-outline-primary">Know
              More</a>
          </div>
        </div>
      </div>
      @if ($recommended_posts)
      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Recomendados</h2>
          <div class="widget-body">
            <div class="widget-list">
              
              @foreach ($recommended_posts as $post)
              <a class="media align-items-center" href="{{$post->slug}}">
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
          <h2 class="section-title mb-3">Categories</h2>
          <div class="widget-body">
            <ul class="widget-list">
             @foreach (\App\Models\Category::with('child')->get() as $category)
             <li><a href="#!">{{$category->name}}<span class="ml-auto">({{$category->posts->count()}})</span></a>
                @foreach ($category->child as $subcategory)
                  <li><a href="#!">{{$subcategory->name}}<span class="ml-auto">({{$subcategory->posts->count()}})</span></a>
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
      </div>
    </div>
  </section>
@endsection
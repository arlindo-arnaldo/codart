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
            @if (latestPost())
            @foreach (latestPost() as $post)
            <article class="card article-card">
              <a href="{{$post->slug}}">
                <div class="card-image">
                  <div class="post-info"> <span class="text-uppercase">{{date('d M Y', strtotime($post->created_at))}}</span>
                    <span class="text-uppercase">{{readDuration($post->title, $post->body)}} @choice('min|mins', readDuration($post->title, $post->body)) de leitura </span>
                  </div>
                  <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100">
                </div>
              </a>
              <div class="card-body px-0 pb-1">
                <ul class="post-meta mb-2">
                  <li>
                    <a href="{{route('category.show',$post->category->slug)}}">{{$post->category->name}}</a>
                    @if ($post->subcategory)
                    <a href="/categories/{{$post->subcategory->parentCategory->slug}}/{{$post->subcategory->slug}}">{{$post->subcategory->name}}</a>
                    @endif
                  </li>
                </ul>
                <h2 class="h1"><a class="post-title" href="{{route('post.show', $post->slug)}}">{{$post->title}}.</a></h2>
                <p class="card-text">{{summarize( $post->body, 35) }}</p>
                <div class="content"> <a class="read-more-btn" href="{{route('post.show', $post->slug)}}">Ler mais</a>
                </div>
              </div>
            </article>
            @endforeach
            @endif
          </div>

          @foreach ($posts as $post)
          <div class="col-md-6 mb-4">
            <article class="card article-card article-card-sm h-100">
              <a href="{{$post->slug}}">
                <div class="card-image">
                  <div class="post-info"> <span class="text-uppercase">{{date('d M Y', strtotime($post->created_at))}}</span>
                    <span class="text-uppercase">{{readDuration($post->title, $post->body)}} @choice('min|mins', readDuration($post->title,$post->body)) de leitura</span>
                  </div>
                  <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100">
                </div>
              </a>
              <div class="card-body px-0 pb-0">
                <ul class="post-meta mb-2">
                  <li> <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a>
                  </li>
                  @if ($post->subcategory)
                  <li> <a href="/categories/{{$post->subcategory->parentCategory->slug}}/{{$post->subcategory->slug}}">{{$post->subcategory->name}}</a>
                  </li>
                  @endif
                </ul>
                <h2><a class="post-title" href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h2>
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
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
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
      @include('site.includes.sidebar')
    </div>
  </div>
</section>
@endsection
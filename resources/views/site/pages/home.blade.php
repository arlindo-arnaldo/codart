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
                  <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100" style="max-height: 450px;">
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
                <p class="card-text">{{summarize( $post->body, 35)}}</p>
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


          
        </div>
      </div>
      @include('site.includes.sidebar', ['type' => '', 'data' => []])
    </div>
  </div>
</section>
@endsection
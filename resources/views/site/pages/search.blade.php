@extends('site.layouts.pages')
@section('title', 'Pesquisa')
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            @if ($posts)
            <div class="col-12">
                <h1 class="mb-4 border-bottom border-primary d-inline-block">Resultados da pesquisa : {{$search}}</h1>
            </div>
            <div class="col-lg-12 mb-5 mb-lg-0">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-md-4 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="{{$post->slug}}">
                                <div class="card-image">
                                    <div class="post-info"> <span class="text-uppercase">{{date('d M Y', strtotime($post->created_at))}}</span>
                                        <span class="text-uppercase">{{readDuration($post->title, $post->body)}} @choice('min|mins', readDuration($post->title, $post->body)) de leitura</span>
                                    </div>
                                    <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100" width="420" height="280">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-0">
                                <ul class="post-meta mb-2">
                                    <li>
                                        <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->slug}}</a>
                                        @if ($post->subcategory)
                                        <a href="/categories/{{$post->subcategory->parentCategory->slug}}/{{$post->subcategory->slug}}">{{$post->subcategory->name}}</a>
                                        @endif
                                    </li>
                                </ul>
                                <h2><a class="post-title" href="{{route('post.show', $post->slug)}}">{{$post->title}}.</a></h2>
                                <p class="card-text">{{summarize($post->body, 30)}}</p>
                                <div class="content"> <a class="read-more-btn" href="{{route('post.show', $post->slug)}}">Ler Mais</a>
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
                                        {{ $posts->links('pagination::bootstrap-4') }}
                                        </ul>
                                    </nav>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @else
            @include('site.errors.404')
            @endif
            @endsection
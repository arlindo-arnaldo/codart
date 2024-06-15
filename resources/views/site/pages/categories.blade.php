@extends('site.layouts.pages')
@section('title', 'home')
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            @if ($posts)
            <div class="col-12">
                <div class="breadcrumbs mb-4"> <a href="{{route('home')}}">Home</a>
                    @if ($category->parentCategory)
                    <span class="mx-1">/</span> <a href="/categories/{{$category->parentCategory->slug}}">{{$category->parentCategory->name}}</a> 
                    @endif
                    
                    <span class="mx-1">/</span> <a href="#!">{{$category->name}}</a>
                </div>
                <h1 class="mb-4 border-bottom border-primary d-inline-block">{{$category->name}}</h1>
            </div>
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="article.html">
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
                                        <a href="{{route('category', $post->category->slug)}}">{{$post->category->slug}}</a>
                                        @if ($post->subcategory)
                                        <a href="/categories/{{$post->subcategory->parentCategory->slug}}/{{$post->subcategory->slug}}">{{$post->subcategory->name}}</a>
                                        @endif
                                    </li>
                                </ul>
                                <h2><a class="post-title" href="{{route('post', $post->slug)}}">{{$post->title}}.</a></h2>
                                <p class="card-text">{{summarize($post->body, 30)}}</p>
                                <div class="content"> <a class="read-more-btn" href="{{route('post', $post->slug)}}">Ler Mais</a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach

                </div>
            </div>
            @include('site.includes.sidebar')
            @else
            @include('site.errors.404')
            @endif
            @endsection
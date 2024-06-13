@extends('site.layouts.pages')
@section('title', 'home')
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            @if ($posts)
            <div class="col-12">
                <div class="breadcrumbs mb-4"> <a href="index.html">Home</a>
                    <span class="mx-1">/</span> <a href="#!">Articles</a>
                    <span class="mx-1">/</span> <a href="#!">Travel</a>
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
                                        <span class="text-uppercase">3 minutes read</span>
                                    </div>
                                    <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100" width="420" height="280">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-0">
                                <ul class="post-meta mb-2">
                                    <li> 
                                        <a href="{{route('category', $post->category->slug)}}">{{$post->category->slug}}</a>
                                        @if ($post->subcategory)
                                        <a href="{{route('category', $post->subcategory->slug)}}">{{$post->subcategory->name}}</a>
                                        @endif
                                    </li>
                                </ul>
                                <h2><a class="post-title" href="{{route('post', $post->slug)}}">{{$post->title}}.</a></h2>
                                <p class="card-text">{{summarize($post->body, 30)}}</p>
                                <div class="content"> <a class="read-more-btn" href="/articles/travel/post-1/">Read Full Article</a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach

                </div>
            </div>
            @include('site.includes.sidebar')
            @endif
            @endsection
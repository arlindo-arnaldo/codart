@extends('site.layouts.pages')
@section('title', "")
@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            @if ($post)
            <div class="col-lg-8 mb-5 mb-lg-0">
                <article>
                    <img loading="lazy" decoding="async" src="/storage/{{$post->thumbnail->path}}" alt="Post Thumbnail" class="w-100" style="max-height: 450px;">
                    <ul class="post-meta mb-2 mt-4">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                                <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                            </svg> <span>{{date('d M, Y', strtotime($post->created_at))}}</span>
                        </li>
                        
                    </ul>
                    <h1 class="my-3">{{$post->title}}</h1>
                    <ul class="post-meta mb-4">
                        <li> <a href="{{route('category.show', $post->category->slug)}}">{{$post->category->name}}</a> </li>
                            @if ($post->subcategory)
                            <li> <a href="/categories/{{$post->subcategory->parentCategory->slug}}/{{$post->subcategory->slug}}">{{$post->subcategory->name}}</a></li>
                            @endif
                    </ul>
                    <div class="content text-left">
                        @php
                         echo $post->body   
                        @endphp
                    </div>
                </article>
                <div class="mt-5">
                    <div id="disqus_thread"></div>
                    
                </div>
            </div>



            @include('site.includes.sidebar', ['type' => 'post', 'data'=>$post])
             @else
                @include('site.errors.404')
            @endif
            @endsection
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
<header class="navigation">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light px-0">
        <a class="navbar-brand order-1 py-0" href="{{route('home')}}">
          <img loading="prelaod" decoding="async" class="img-fluid" src="/site-assets/images/logo.png" alt="Reporter Hugo">
        </a>
        <div class="navbar-actions order-3 ml-0 ml-md-4">
          <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
            data-target="#navigation"> <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <form action="#!" class="search order-lg-3 order-md-2 order-3 ml-auto">
          <input id="search-query" name="s" type="search" placeholder="Procurar" autocomplete="off">
        </form>
        <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
          <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
            <li class="nav-item"> <a class="nav-link" href="{{route('articles')}}">Artigos</a>
            </li>
            @foreach (\App\Models\Category::whereHas('child', function($q){$q->whereHas('posts');})->where('slug', '!=', 'sem-categoria')->get() as $category)
            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="/categories/{{$category->slug}}" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{$category->name}}
            </a>
            <div class="dropdown-menu">
              @foreach (\App\Models\SubCategory::where('parent_id', $category->id)->whereHas('posts')->get() as $subcategory)
                  <a class="dropdown-item" href="/categories/{{$category->slug}}/{{$subcategory->slug}}">{{$subcategory->name}}</a>
              @endforeach
               
              
            </div>
          </li>
            @endforeach
            
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
<nav class="navbar navbar-expand-lg bg-body-white bg-white">
  <div class="container">
    <a class="navbar-brand" href="/">Fashion Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <div class="dropdown">
          <a class="nav-link btn custom-highlight" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu p-2">
            @foreach ($categories as $category)
            <li><a class="dropdown-item custom-highlight" href="/categories/{{ $category->slug }}">{{ $category->name }}</a></li>
            @endforeach
          </ul>
        </div>

        <li class="nav-item">
          <a class="nav-link custom-highlight" aria-current="page" href="/">Deals</a>
        </li>

        <form class="d-flex mx-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn custom-btn-outline" type="submit">Search</button>
        </form>
      </ul>
     
    </div>

    <ul class="navbar-nav">

      <li class="nav-item me-2">
        <a class="nav-link custom-highlight position-relative" href="/cart"><i class="size-icon" data-feather="shopping-cart"></i>
          @auth
            @if (auth()->user()->product_cart->sum("pivot.quantity") != 0)
            <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger">
              {{ auth()->user()->product_cart->sum("pivot.quantity") }}
            @endif
          @endauth
        </a>
      </li>

      <div class="vr mx-3 my-2"></div>
  
      @auth
      <li class="nav-item">
        <div class="dropdown">
          <a class="nav-link btn custom-highlight" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i data-feather="user"></i>
            {{ auth()->user()->name }}
          </a>
        
          <ul class="dropdown-menu p-2">
            <li>
              <a class="dropdown-item custom-highlight" href="/purchase">Purchase</a>
            </li>
            <li>
              <a class="dropdown-item custom-highlight" href="/wishlist">Wishlist</a>
            </li>

            <li>
              <a class="dropdown-item custom-highlight" href="/settings">Settings</a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
              <form action="/logout" method="POST">
                @csrf
                <button class="dropdown-item custom-highlight" href="/logout">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </li>
      @else
        <li class="nav-item me-2">
          <a class="btn custom-btn-outline" href="/login">Login</a>
        </li>
        
        <li class="nav-item">
          <a class="btn custom-btn-outline-reverse" href="/register">Register</a>
        </li>
      @endauth
    </ul>
  </div>
</nav>
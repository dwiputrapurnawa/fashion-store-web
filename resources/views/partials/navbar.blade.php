<nav class="navbar navbar-expand-lg bg-body-white bg-white">
  <div class="container">
    <a class="navbar-brand" href="/">Fashion Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Deals</a>
        </li>

        <form class="d-flex mx-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn custom-btn-outline" type="submit">Search</button>
        </form>
      </ul>
     

      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="/cart"><i class="fa-solid fa-cart-shopping"></i></a>
        </li>

        @auth
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-user"></i>
            </a>
          
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="/purchase">Purchase</a>
              </li>
              <li>
                <a class="dropdown-item" href="/wishlist">Wishlist</a>
              </li>

              <li>
                <a class="dropdown-item" href="/settings">Settings</a>
              </li>

              <li><hr class="dropdown-divider"></li>

              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button class="dropdown-item" href="/logout">Logout</button>
                </form>
              </li>



              
            </ul>
          </div>
        </li>
      </ul>
          

        @else
        <li class="nav-item">
          <a class="nav-link text-decoration-none text-dark" href="/login">Login</a>
        </li>
        @endauth

     

    </div>
  </div>
</nav>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashion Store - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9766b12ac0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/sign-in.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin m-auto rounded">

      @if (session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session()->has("error"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("error") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form action="/login" method="POST">
          @csrf
          <h1 class="h3 mb-3 fw-bold text-center">Login</h1>
      
          <div class="form-floating">
            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
            <label for="email">Email address</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
            <label for="password">Password</label>
          </div>

          <div class="row my-3">
            <div class="col-sm-auto">
              <input class="form-check-input" type="checkbox" id="rememberme" name="rememberme">
              <label class="form-check-label" for="rememberme">
                Remember me
              </label>
            </div>
  
            <div class="mb-3 col-sm">
              <a class="text-decoration-none custom-text-color float-end" href="#">Forget password?</a>
            </div>
          </div>
      
          

          <button class="btn custom-btn w-100 py-2" type="submit">Login</button>

          <p class="mt-3">Not have account? <a class="text-decoration-none custom-text-color" href="/register">Register here!</a></p>

          <p class="mt-5 mb-3 text-body-secondary copyright"></p>
        </form>
      </main>

      <script src="/js/sign-in.js"></script>
</body>
</html>
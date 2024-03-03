<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{ asset('css/app.css')}}"> 
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
        <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Iniciar sesión</h2>
              <p class="text-white-50 mb-5">Introduce el email y la contraseña de la cuenta a la que quieres acceder</p>
              <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <div class="form-outline form-white mb-4">
                <input type="email" id="email" class="form-control form-control-lg" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <label class="form-label" for="typeEmailX">Email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>

              <div class="form-outline form-white mb-4">
                <input id="password" name="password" type="password" class="form-control form-control-lg" required autocomplete="current-password" />
                <label class="form-label" for="typePasswordX">Contraseña</label>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>

              @if (Route::has('password.request'))
              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="{{ route('password.request') }}">¿Olvidaste la contraseña?</a></p>
              @endif

              <button class="btn btn-outline-light btn-lg px-5">Iniciar sesión</button>
            </form>
            </div>

            <div>
              <p class="mb-0">¿No tienes una cuenta? <a href="{{route('register')}}" class="text-white-50 fw-bold">Registrarse</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

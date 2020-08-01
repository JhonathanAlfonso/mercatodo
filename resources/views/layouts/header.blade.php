<div id="top-bar" class="container">
    <div class="d-flex justify-content-between align-items-center">
            <form method="POST" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Ingrese el articulo">
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        <div class="account float-right">
            <ul class="user-menu">


                    @guest()
                        <li><a href={{ route('login') }}>Ingresar</a></li>
                    @else
                        <li><a href="{{ route('pages.user-account.update', auth()->user()) }}">Mi cuenta</a></li>

                        @if(auth()->user()->hasRole('Admin'))
                        <li><a href={{ route('admin.dashboard') }}>Administración</a></li>
                        @else

                            <li><a href="{{ route('pages.your-car') }}">Tu carrito</a></li>
                            <li><a href="{{ route('pages.checkout') }}">Checkout</a></li>
                        @endif
                        <li>
                            <a href='#'
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"
                            >Cerrar sesión</a>
                        </li>
                    @endguest

            </ul>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" display="none">
    @csrf
</form>

<div id="app">
<div id="wrapper" class="container">
    <section class="navbar-nav">
        <div class="navbar-inner main-menu d-flex mb-4">
            <a href="{{ route('home') }}" class="mr-auto"><img src="/shooper/themes/images/logo.png" class="site_logo" alt=""></a>
            <nav id="menu" class="">
                <ul>
                    <li><a href="{{ route('pages.tag.show', 'mujer') }}">Mujer</a></li>
                    <li><a href="{{ route('pages.tag.show', 'hombre') }}">Hombre</a></li>
                </ul>
            </nav>
        </div>
    </section>

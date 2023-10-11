<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto Sans|AR One Sans|Mooli|DM Sans|Sofia Sans">

    <link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/progress_circle.css') }}">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <header class="my-0">
        <nav class="navbar bg-body-tertiary fixed-top my-0 navbar-toggle">
            <div class="container-fluid  navbar-toggle">
                <div class="d-flex justify-content-between align-items-center">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand ms-3" href="/index">TaskFlow</a>
                    
       
                    
                </div>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">TaskFlow</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-start flex-grow-1 ps-3"> 

                        <li class="nav-item">
                            <div class="d-flex align-items-center">
                                <span><i class="fa-solid fa-user fa-lg"></i></span>
                                <a class="nav-link active mx-3 fs-5" aria-current="page">{{ Auth::user()->name }}</a>
                            </div>
                        </li>
                            
                            <li class="nav-item">
                                <div class="d-flex align-items-center">
                                    <span><i class="fa-solid fa-house fa-lg"></i></span>
                                    <a class="nav-link active mx-3 fs-5" aria-current="page" href="/index">Home</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <div class="d-flex align-items-center">
                                    <span><i class="fa-solid fa-list-check fa-lg"></i></span>
                                    <a class="nav-link active mx-3 fs-5" aria-current="page" href="/log">Log</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <div class="d-flex align-items-center">
                                    <span><i class="fa-solid fa-chart-simple fa-lg"></i></span>
                                    <a class="nav-link active mx-3 fs-5" aria-current="page" href="/task_analytics">Analytics</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <div class="d-flex align-items-center">
                                    <span><i class="fa-solid fa-right-from-bracket fa-lg" style="color: #ff0000;"></i></span>
                                    <a class="nav-link mx-3 fs-5" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>

    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('assets/scripts/main.js') }}"></script>
    
    <script src="https://kit.fontawesome.com/b601c2aada.js" crossorigin="anonymous"></script>

    

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8Nhl_ddukmX7vivBRNskl9aSievkRVDk&libraries=places&callback=initMap"></script>

</body>
</html>




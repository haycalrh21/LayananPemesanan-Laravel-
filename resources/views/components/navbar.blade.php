<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <style>
        @media (min-width: 992px) {
            .index-link {
                display: none;
            }
        }

        body.dark-mode {
            background-color: #333;
            color: #fff;
        }

        .navbar-dark .navbar-toggler-icon {
            background-color: #fff;
        }

        .navbar-dark .navbar-toggler {
            border-color: #fff;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-dark .navbar-toggler-icon {
            background-color: #fff;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand index-link" href="{{ route('home') }}">Index</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('semualayanan') }}">Layanan</a>
                </li>

                @if(auth()->check() && auth()->user()->role !== 'vendor')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jadivendor') }}">Vendor</a>
                    </li>
                @endif

                @guest
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login / Register
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                            <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                        </div>
                    </li>
                @endguest

                @auth
                    @if (auth()->check() && auth()->user()->role!== 'user')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Profile
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">Company</a>
                                {{-- <a class="dropdown-item" href="{{ route('vendor.index') }}">Iklan Layanan</a> --}}
                                <a class="dropdown-item" href="{{ route('formpesanan') }}">Form Layanan</a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('bikinpesan') }}">Pesan</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                @endauth
            </ul>
            <button onclick="toggleDarkMode()">Toggle Dark Mode</button>
        </div>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <!-- Include Popper.js and Bootstrap JS -->


            <script>
                // Function to toggle dark mode
                function toggleDarkMode() {
                    const isDarkMode = document.body.classList.toggle('dark-mode');
                    // Simpan preferensi ke localStorage
                    localStorage.setItem('darkMode', isDarkMode);
                }

                // Function to check dark mode preference
                function checkDarkModePreference() {
                    const isDarkMode = localStorage.getItem('darkMode') === 'true';
                    document.body.classList.toggle('dark-mode', isDarkMode);
                }

                // Call checkDarkModePreference when the page loads
                document.addEventListener('DOMContentLoaded', checkDarkModePreference);
            </script>
    </nav>
</body>

</html>

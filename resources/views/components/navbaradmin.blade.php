<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
            /* transition: 5ms; */
        }

        body.dark-mode {
            background-color: #333;
            color: white;
        }

        nav {
            background-color: #333;
            padding: 15px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap; /* Allow the items to wrap into multiple lines on smaller screens */
            justify-content: left;
            margin: 0; /* Remove default margin */
        }

        nav li {
            position: relative; /* Set position to relative for absolute positioning */
            margin-right: 20px;
            margin-bottom: 10px; /* Add margin between items */
        }

        nav a {
            text-decoration: none;
            color: white;
            /* transition: color 0.3s; */
            display: block;
            padding: 10px;
        }

        nav a:hover {
            color: #f70e35;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 100%; /* Position dropdown below the parent item */
            left: 0;
            background-color: #333;
            cursor: pointer;

            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 10px;
            width: 200px; /* Adjust the width as needed */
        }

        .dropdown a {
            color: white;
            text-decoration: none;
            cursor: pointer;

            display: block;
            padding: 10px;
            /* transition: background-color 0.3s; */
        }

        .dropdown a:hover {
            background-color: #555;
        }

        /* Show the dropdown on hover for larger screens */
        @media only screen and (min-width: 768px) {
            nav li:hover .dropdown {
                display: block;
            }
        }

        .dark-mode-btn {
            color: white;
            border: none;
            cursor: pointer;
            /* transition: background-color 0.3s; */
        }

        .dark-mode-btn:hover {
            background-color: #777;
        }
    </style>
    <title>Your Title Here</title>
</head>
<body>
    <section>
        <div class="1">
            <nav id="navbar">
                <ul>
                    <li>
                        <a href="{{ route('admin.index') }}">Home</a>
                        <a href="{{ route('pesan') }}">pesan</a>


                    </li>

                    <li>
                        <a >Layanan</a>
                        <!-- Dropdown for Login -->
                        <div class="dropdown">
                            <a href="{{ route('datalayanan') }}">Data Layanan</a>
                            <a href="{{ route('datauser') }}">Data User</a>
                            <a href="{{ route('datavendor') }}">Data Vendor</a>
                        </div>
                    </li>

                    @auth
                        <li>
                            <a href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <!-- Dropdown for Logout -->

                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="post">
                            @csrf
                        </form>
                    @endauth
                    <div class="dropdown-content">
                        <a href="#" onclick="toggleDarkMode()"> Dark Mode</a>
                    </div>
                    {{-- Dropdown for Dark Mode --}}
                    <li class="dropdown">

                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const isDarkModeEnabled = localStorage.getItem('darkMode') === 'enabled';

            if (isDarkModeEnabled) {
                document.body.classList.add('dark-mode');
            }
        });

        function toggleDarkMode() {
            const isCurrentlyDarkMode = document.body.classList.contains('dark-mode');
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', isCurrentlyDarkMode ? 'disabled' : 'enabled');
        }
    </script>
</body>
</html>

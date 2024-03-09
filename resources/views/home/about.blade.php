<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        navbar ul {
            list-style: none;
            padding: 0;
            display: flex;
            margin: center;
            /* margin-left: auto;
            margin-right: auto; */
        }

        navbar li {
            margin-right: 20px;
        }

        navbar a {
            text-decoration: none;
            color: black;
        }
    </style>
    <title>Horizontal Navbar</title>
</head>
<body>
    <section>
        @include('components.navbar')
      </section>

    <section>
        <div>
            <h1>Halaman About</h1>
        </div>
    </section>
</body>
</html>

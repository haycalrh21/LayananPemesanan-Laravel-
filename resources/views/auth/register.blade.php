<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
  section {
        text-align: center;
    }

    .iniform {
        width: 300px; /* Sesuaikan lebar formulir sesuai kebutuhan */
        margin: 0 auto; /* Mengatur margin otomatis agar berada di tengah */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-top: 10%;

        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

        .custom-button {
        background-color: green;
        color: white;
        padding: 10px 20px; /* Ubah ukuran padding sesuai kebutuhan untuk membuat tombol lebih besar */
        border-radius: 10px; /* Menentukan tingkat kebulatan sudut */
        font-size: 16px; /* Menentukan ukuran font */
        cursor: pointer;
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
            @if ($errors->any())
            <div>
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="iniform">
            <h1>Halaman Register</h1>

                               <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf


                    <div style="display: flex; flex-direction: column; margin-bottom: 15px;">

                        <label style="width: 0%; margin-right: 0;">Nama:</label>


                    <input type="text" name="name" placeholder="masukan name"  value="{{ old('name') }}" required  style="flex: 1; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">

                    </div>
                    <div style="display: flex; flex-direction: column; margin-bottom: 15px;">

                        <label style="width: 0%; margin-right: 0;">Email:</label>


                    <input type="text" name="email" placeholder="masukan email"  value="{{ old('email') }}" required  style="flex: 1; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">

                    </div>

                    <div style="display: flex; flex-direction: column; margin-bottom: 15px;">

                        <label style="width: 0%; margin-right: 0;">Password:</label>


                    <input type="password" name="password" placeholder="masukan password" id="password"  required  style="flex: 1; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">

                    </div>

                    <div style="display: flex; flex-direction: column; margin-bottom: 15px;">

                        <label style="width: 0%; margin-right: 0;">Confirm Password:</label>


                    <input type="password" name="password_confirmation" placeholder="masukan  password" id="password_confirmation"  required  style="flex: 1; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">

                    </div>

                    <button type="submit" class="custom-button">Register</button>

                    <button type="button" class="custom-button" onclick="window.location.href='{{ route('googlelogin') }}'">Google</button>



                </form>





            </div>
        </div>
    </section>
</body>

</html>

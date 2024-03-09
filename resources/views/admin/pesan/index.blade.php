<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Pesan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }


        .message-container {
            margin: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            max-width: 70%;
        }

        .user-message {
            background-color: orange;
            text-align: left;
        }

        .admin-message {
            background-color: #4caf50;
            color: white;
            text-align: right;
        }

        form {
            margin-top: 10px;
        }

        textarea {
            width: auto;
            margin-bottom: 5px;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        p{
            margin: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            max-width: 70%;
            background-color: white;

        }
    </style>
</head>

<body>
    @include("components.navbaradmin")
    <h1>Halaman Pesan</h1>

    <section>
        <div>
            @foreach ($messages as $message)
            <div class="message-container {{ $message->is_admin_reply ? 'admin-message' : 'user-message' }}">
                @if (!$message->is_admin_reply)
                <p><strong>Pengguna:</strong> {{ $message->user->name }}</p>
                @endif
                <p><strong>Isi Pesan:</strong> {{ $message->content }}</p>

                @foreach ($message->replies as $reply)
                <div class="message-container {{ $reply->is_admin_reply ? 'admin-message' : 'user-message' }}">
                    @if ($reply->is_admin_reply)
                    <h5><strong>Admin:</strong> {{ $reply->content }}</h5>
                    @else
                    <h5><strong>Pengguna:</strong> {{ $reply->content }}</h5>
                    @endif
                </div>
                @endforeach

                {{-- Tambahkan formulir untuk admin membalas pesan --}}
                <form action="{{ route('balespesan', ['id' => $message->id]) }}" method="post">
                    @csrf
                    <label for="adminReply">Balas Pesan:</label>
                    <textarea name="adminReply" id="adminReply" rows="3"></textarea>
                    <button type="submit">Kirim Balasan</button>
                </form>
            </div>
            @endforeach
        </div>
    </section>
</body>

</html>

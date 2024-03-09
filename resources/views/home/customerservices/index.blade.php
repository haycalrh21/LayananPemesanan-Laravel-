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

        section {
            max-width: 800px;
            margin: 0 auto;
        }

        .message-container {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            max-width: 70%;
        }

        .admin-message {
            background-color: #4caf50;
            color: white;
        }

        .user-message {
            background-color: #f0f0f0;
        }

        .text-align-left {
            text-align: left;
        }

        .text-align-right {
            text-align: right;
        }

        form {
            margin-top: 10px;
        }

        textarea {
            width: 100%;
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
    </style>
</head>
<body>
    @include("components.navbar")
    <h1>Halaman Pesan</h1>

    <section>
        <div>
            @isset($messages)
                @foreach ($messages as $message)
                    @php
                        $messageClass = $message->user ? 'user-message text-align-right' : 'admin-message text-align-left';
                    @endphp
                    <div class="message-container {{ $messageClass }}">
                        <p><strong>{{ $message->user ? 'Pengguna' : 'Admin' }}:</strong> {{ $message->content }}</p>

                        @isset($message->replies)
                            @foreach ($message->replies as $reply)
                                @php
                                    $replyClass = $reply->is_admin_reply ? 'admin-message text-align-left' : 'user-message text-align-right';
                                @endphp
                                <div class="message-container {{ $replyClass }}">
                                    <p><strong>{{ $reply->is_admin_reply ? 'Admin' : 'Pengguna' }} Reply:</strong> {{ $reply->content }}</p>
                                </div>

                            @endforeach
                        @endisset

                        @if (!$message->user)
                            <form action="{{ route('kirimpesan', ['id' => $message->id]) }}" method="post">
                                @csrf
                                <label for="adminReply">Balas Pesan:</label>
                                <textarea name="adminReply" id="adminReply" rows="3"></textarea>
                                <button type="submit">Kirim Balasan</button>
                            </form>

                        @endif
                    </div>

                @endforeach
                <form action="{{ route('kirimpesan') }}" method="post">
                    @csrf
                    <label for="content">Isi Pesan:</label>
                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
                    <br>
                    <button type="submit">Kirim</button>
                </form>
            @endisset
        </div>
    </section>
    {{-- <a href="{{ route('layananpesan') }}">Kirim Pesan</a> --}}
</body>
</html>

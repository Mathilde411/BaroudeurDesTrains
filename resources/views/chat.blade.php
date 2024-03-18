<html>
<head>
    <title>Home</title>
    @vite('resources/js/app.js')
</head>
<body>
    <div>
        <table>
            <thead>
            <tr>
                <th>
                    Pseudo
                </th>
                <th>
                    Message
                </th>
            </tr>
            </thead>
            <tbody id="messages">
            @foreach($conversation->messages as $message)
                <tr>
                    <td>
                        {{$message->user->pseudo}}
                    </td>
                    <td>
                        {{$message->message}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form id="envoi" method="POST" action=".">
            <label>
                Message
                <textarea name="message"></textarea>
            </label>
            <input type="submit" value="Envoyer">
        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('envoi');
            const message = form.getElementsByTagName('textarea')[0];
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                let formData = new FormData(form);
                window.axios.post('{{route('sendMessage', ['conversation' => $conversation->id])}}', formData);
                message.textContent = '';
            });
        });
    </script>
</body>
</html>

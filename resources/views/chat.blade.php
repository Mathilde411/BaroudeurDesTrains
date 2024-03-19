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
                    Timestamp
                </th>
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
                        {{$message->created_at->format('d/m/Y h:i:s')}}
                    </td>
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
            const messages = document.getElementById('messages');

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                let formData = new FormData(form);
                window.axios.post('{{route('sendMessage', ['conversation' => $conversation->id])}}', formData);
                message.value = '';
            });

            Echo.private(`conversation.{{$conversation->id}}`)
                .listen('.message.received', (e) => {

                    const tr = document.createElement('tr');

                    let td = document.createElement('td');
                    td.appendChild(document.createTextNode((new Date(e.message.created_at)).toLocaleString('fr-fr')));
                    tr.appendChild(td);

                    td = document.createElement('td');
                    td.appendChild(document.createTextNode(e.user.pseudo));
                    tr.appendChild(td);

                    td = document.createElement('td');
                    td.appendChild(document.createTextNode(e.message.message));
                    tr.appendChild(td);

                    messages.appendChild(tr);
                });
        });
    </script>
</body>
</html>

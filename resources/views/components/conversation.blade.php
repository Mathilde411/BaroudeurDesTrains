<div class="chat">
    <div class="messages">
        @foreach($conversation->messages as $message)
            <div class="message">
                <div class="sender">{{$message->user->pseudo}} :</div>
                <div class="text">{{$message->message}}</div>
            </div>
        @endforeach


    </div>
    <div class="send">
        <form id="envoi" method="POST" action=".">
            <input class="text" type="text" name="message">
            <input type="submit" value="Envoyer">
        </form>
    </div>
</div>

@pushonce('style')
    @vite('resources/css/conversation.scss')
@endpushonce

@pushonce('scripts')
    <script>
        window.conversation = {}
        window.conversation.conversationLink = '{{route('sendMessage', ['conversation' => $conversation->id])}}'
        window.conversation.conversationId = '{{$conversation->id}}'
    </script>
    @vite('resources/js/conversation.js')
@endpushonce
